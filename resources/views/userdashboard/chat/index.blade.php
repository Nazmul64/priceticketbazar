@extends('userdashboard.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.chat-wrapper { display:flex; height:90vh; border-radius:10px; overflow:hidden; border:1px solid #e0e0e0; box-shadow:0 4px 15px rgba(0,0,0,0.1); background:#f7f9fc; }
.chat-sidebar { width:300px; background:#f9f9f9; border-right:1px solid #e0e0e0; display:flex; flex-direction:column; }
.sidebar-header { padding:15px; font-weight:bold; border-bottom:1px solid #ddd; }
.chat-list { flex:1; overflow-y:auto; }
.chat-list .chat-user { display:flex; align-items:center; padding:12px 15px; cursor:pointer; transition:.2s; }
.chat-list .chat-user:hover { background:#f1f1f1; }
.chat-list .chat-user img { width:36px; height:36px; border-radius:50%; margin-right:10px; object-fit:cover; }
.chat-list .chat-user .name { font-size:14px; font-weight:600; }
.chat-list .chat-user .msg { font-size:12px; color:gray; }

.chat-area { flex:1; display:flex; flex-direction:column; background:#fff; }
.chat-header { padding:15px; border-bottom:1px solid #ddd; font-weight:600; display:flex; justify-content:space-between; align-items:center; }
.chat-messages { flex:1; padding:20px; overflow-y:auto; display:flex; flex-direction:column; background:#fff; }
.message { margin-bottom:15px; max-width:70%; padding:10px 15px; border-radius:15px; font-size:14px; line-height:1.4; position:relative; }
.message small { display:block; color:gray; font-size:11px; margin-top:5px; }
.message.admin { align-self:flex-start; background:#fff; border:1px solid #eee; }
.message.user { align-self:flex-end; background:#d8ecff; }
.chat-input { padding:12px; background:#f9f9f9; border-top:1px solid #eee; display:flex; flex-direction:column; }
.chat-input textarea { border-radius:12px; border:1px solid #ddd; padding:10px 15px; font-size:14px; resize:none; height:60px; margin-bottom:10px; }
.chat-input button { align-self:flex-end; border-radius:12px; padding:8px 25px; font-size:14px; }
</style>

<div class="container-fluid py-4">
    <div class="chat-wrapper">

        <!-- Sidebar: User/Admin List -->
        <div class="chat-sidebar">
            <div class="sidebar-header">Chats</div>
            <div class="chat-list" id="chatList"></div>
        </div>

        <!-- Chat Area -->
        <div class="chat-area">
            <div class="chat-header">
                <span id="chatWith">Select a chat</span>
            </div>

            <div class="chat-messages" id="chatMessages"></div>

            <!-- Chat Input -->
            <div class="chat-input">
                @csrf
                <textarea id="chatInput" placeholder="Type your message..."></textarea>
                <button id="sendBtn" class="btn btn-primary mt-2">Send</button>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let receiverId = null;

// Load user/admin list
function loadUserList(){
    $.get("{{ route('user.chat.list') }}", function(users){
        let html = '';
        users.forEach(u => {
            let avatar = u.photo ? u.photo : 'https://i.pravatar.cc/36?img='+u.id;
            html += `<div class="chat-user" data-id="${u.id}">
                        <img src="${avatar}" alt="${u.name}">
                        <div>
                            <div class="name">${u.name} ${u.is_admin ? '(Admin)' : ''}</div>
                            <div class="msg">${u.last_msg ?? ''}</div>
                        </div>
                    </div>`;
        });
        $('#chatList').html(html);

        // Click to open chat
        $('.chat-user').off('click').on('click', function(){
            receiverId = $(this).data('id');
            $('#chatWith').text('Conversation with '+$(this).find('.name').text());
            fetchMessages();
        });
    });
}

// Fetch messages between auth user and selected receiver
function fetchMessages(){
    if(!receiverId) return;
    $.get("{{ route('user.chat.fetch') }}", {receiver_id:receiverId}, function(data){
        let chatBox = $('#chatMessages');
        chatBox.html('');
        data.forEach(msg => {
            let cls = msg.sender_id == {{ Auth::id() }} ? 'user' : 'admin';
            chatBox.append('<div class="message '+cls+'">'+
                           $('<div>').text(msg.message).html() + // XSS-safe
                           '<small>'+ new Date(msg.created_at).toLocaleTimeString() +'</small></div>');
        });
        chatBox.scrollTop(chatBox[0].scrollHeight);
    });
}

// Send message (no alert; default admin=1 if none selected)
$('#sendBtn').on('click', function(){
    let message = $('#chatInput').val();
    if(message.trim()=='') return;

    let finalReceiver = receiverId ? receiverId : 1;

    $.post("{{ route('user.chat.send') }}", {
        _token:'{{ csrf_token() }}',
        message: message,
        receiver_id: finalReceiver
    }, function(){
        $('#chatInput').val('');
        if(receiverId) { fetchMessages(); }
        loadUserList();
    });
});

// Enter key to send
$('#chatInput').on('keypress', function(e){
    if(e.which==13 && !e.shiftKey){
        e.preventDefault();
        $('#sendBtn').click();
    }
});

// Auto refresh messages every 2 sec (only if a chat is open)
setInterval(fetchMessages, 2000);

// Initial load
loadUserList();
</script>
@endsection
