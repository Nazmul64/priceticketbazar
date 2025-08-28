@extends('userdashboard.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
* { box-sizing: border-box; }

body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.chat-wrapper {
    display: flex;
    height: 90vh;
    border-radius: 20px;
    overflow: hidden;
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 25px 45px rgba(0,0,0,0.1);
    margin: 20px;
}

/* Modern Sidebar */
.chat-sidebar {
    width: 350px;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
    backdrop-filter: blur(20px);
    border-right: 1px solid rgba(255, 255, 255, 0.3);
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    padding: 25px 20px;
    font-weight: 700;
    font-size: 18px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.sidebar-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.sidebar-header:hover::before { left: 100%; }

.chat-list {
    flex: 1;
    overflow-y: auto;
    padding: 10px 0;
}

.chat-list::-webkit-scrollbar { width: 6px; }
.chat-list::-webkit-scrollbar-track { background: transparent; }
.chat-list::-webkit-scrollbar-thumb {
    background: rgba(102, 126, 234, 0.3);
    border-radius: 10px;
}

.chat-user {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    margin: 5px 10px;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.5);
}

.chat-user:hover {
    background: rgba(102, 126, 234, 0.1);
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.chat-user.active {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    transform: translateX(5px);
}

.chat-user img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-right: 15px;
    object-fit: cover;
    border: 3px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.chat-user:hover img { transform: scale(1.1); }

.chat-user .user-info { flex: 1; }

.chat-user .name {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 3px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.chat-user .admin-badge {
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    font-weight: 500;
}

.chat-user .msg {
    font-size: 12px;
    color: #666;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
}

.chat-user.active .msg { color: rgba(255, 255, 255, 0.8); }

.notification-badge {
    position: absolute;
    top: 10px;
    right: 15px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Modern Chat Area */
.chat-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
}

.chat-header {
    padding: 20px 25px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
    backdrop-filter: blur(10px);
}

.chat-header .status-dot {
    width: 8px;
    height: 8px;
    background: #4CAF50;
    border-radius: 50%;
    margin-left: 10px;
    animation: blink 2s infinite;
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0.3; }
}

.chat-messages {
    flex: 1;
    padding: 20px 25px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
}

.chat-messages::-webkit-scrollbar { width: 8px; }
.chat-messages::-webkit-scrollbar-track { background: transparent; }
.chat-messages::-webkit-scrollbar-thumb {
    background: rgba(102, 126, 234, 0.3);
    border-radius: 10px;
}

.message {
    margin-bottom: 20px;
    max-width: 75%;
    padding: 15px 20px;
    border-radius: 20px;
    font-size: 14px;
    line-height: 1.5;
    position: relative;
    animation: fadeInUp 0.3s ease;
    word-wrap: break-word;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.message small {
    display: block;
    font-size: 11px;
    margin-top: 8px;
    opacity: 0.7;
}

.message.admin {
    align-self: flex-start;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 1px solid rgba(102, 126, 234, 0.2);
    color: #333;
    border-bottom-left-radius: 5px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.message.user {
    align-self: flex-end;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-bottom-right-radius: 5px;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
}

.message.admin::before {
    content: '';
    position: absolute;
    left: -8px;
    bottom: 0;
    width: 0;
    height: 0;
    border: 8px solid transparent;
    border-right-color: #f8f9fa;
    border-left: 0;
    border-bottom: 0;
}

.message.user::before {
    content: '';
    position: absolute;
    right: -8px;
    bottom: 0;
    width: 0;
    height: 0;
    border: 8px solid transparent;
    border-left-color: #764ba2;
    border-right: 0;
    border-bottom: 0;
}

/* Modern Input Area */
.chat-input {
    padding: 20px 25px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
    border-top: 1px solid rgba(255, 255, 255, 0.3);
    display: flex;
    gap: 15px;
    align-items: flex-end;
    backdrop-filter: blur(10px);
}

.chat-input textarea {
    flex: 1;
    border-radius: 20px;
    border: 2px solid rgba(102, 126, 234, 0.2);
    padding: 15px 20px;
    font-size: 14px;
    resize: none;
    min-height: 50px;
    max-height: 120px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    font-family: inherit;
}

.chat-input textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: rgba(255, 255, 255, 0.95);
}

.chat-input button {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    border: none;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.chat-input button:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.chat-input button:active { transform: scale(0.95); }

/* Loading Animation */
.typing-indicator {
    display: none;
    align-self: flex-start;
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 20px;
    border-bottom-left-radius: 5px;
    margin-bottom: 20px;
    max-width: 75%;
}

.typing-indicator span {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #667eea;
    margin: 0 2px;
    animation: typing 1.4s infinite;
}

.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-10px); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .chat-wrapper { margin: 10px; height: 95vh; }
    .chat-sidebar { width: 280px; }
    .message { max-width: 85%; }
}

@media (max-width: 576px) {
    .chat-sidebar { width: 100%; position: absolute; z-index: 1000; }
    .chat-area { width: 100%; }
}
</style>

<div class="container-fluid py-2">
    <div class="chat-wrapper">

        <!-- Modern Sidebar -->
        <div class="chat-sidebar">
            <div class="sidebar-header">
                <i class="fas fa-comments me-2"></i>
                Messages
            </div>
            <div class="chat-list" id="chatList"></div>
        </div>

        <!-- Modern Chat Area -->
        <div class="chat-area">
            <div class="chat-header">
                <div class="d-flex align-items-center">
                    <span id="chatWith">Select a conversation</span>
                    <div class="status-dot" id="statusDot" style="display:none;"></div>
                </div>
                <div>
                    <i class="fas fa-phone me-2 text-muted"></i>
                    <i class="fas fa-video me-2 text-muted"></i>
                    <i class="fas fa-info-circle text-muted"></i>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                <div class="text-center text-muted py-5">
                    <i class="fas fa-comments fa-3x mb-3 opacity-50"></i>
                    <p>Select a conversation to start messaging</p>
                </div>
            </div>

            <!-- Typing Indicator -->
            <div class="typing-indicator" id="typingIndicator">
                <span></span><span></span><span></span>
            </div>

            <!-- Modern Chat Input -->
            <div class="chat-input">
                @csrf
                <textarea id="chatInput" placeholder="Type your message..." rows="1"></textarea>
                <button id="sendBtn" class="btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Notification Sound -->
<audio id="notificationSound" preload="auto">
    <source src="data:audio/mpeg;base64,SUQzBAAAAAABEVRYWFgAAAAtAAADY29tbWVudABCaWdTb3VuZEJhbmsuY29tIC8gTGFTb25vdGhlcXVlLm9yZwBURU5DAAAAHQAAADNDSW5lVGVhLmNvbSAyMDA5IHRvIDIwMTAAVFBFMQAAAAwAAABGcmVlIERvd25sb2FkAFRJVDIAAAAPAAAATm90aWZpY2F0aW9uAFRZRVIAAAAEAAAAMjAxNAA" type="audio/mpeg">
</audio>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let receiverId = null;
let lastMessageCount = 0;
let unreadMessages = {};
let currentUserMessages = {};

// Create notification sound from base64
const notificationSound = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBjWJ0fPTgjMGHm7A7+OZSA0PVqzn77BdGAg+ltryxnkpBSl+zPLaizsIGGS57+STQw0NUarm7bJgGgU2jdXzzn0vBSF1xe/glEILElyx5+iTUBELTKXh8bllHgg2jdT0z3wsBSJ0yO/glEILElyx5+iTUBELTKXh8bllHgg');

// Auto-resize textarea
$('#chatInput').on('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});

// Load user/admin list with notification count
function loadUserList(){
    $.get("{{ route('user.chat.list') }}", function(users){
        let html = '';
        users.forEach(u => {
            let avatar = u.photo ? u.photo : 'https://i.pravatar.cc/45?img='+u.id;
            let unreadCount = unreadMessages[u.id] || 0;
            let lastMsg = u.last_msg ? (u.last_msg.length > 30 ? u.last_msg.substring(0, 30) + '...' : u.last_msg) : 'No messages yet';

            html += `<div class="chat-user ${receiverId == u.id ? 'active' : ''}" data-id="${u.id}">
                        <img src="${avatar}" alt="${u.name}">
                        <div class="user-info">
                            <div class="name">
                                ${u.name}
                                ${u.is_admin ? '<span class="admin-badge"><i class="fas fa-crown me-1"></i>Admin</span>' : ''}
                            </div>
                            <div class="msg">${lastMsg}</div>
                        </div>
                        ${unreadCount > 0 ? `<div class="notification-badge">${unreadCount}</div>` : ''}
                    </div>`;
        });
        $('#chatList').html(html);

        // Click to open chat
        $('.chat-user').off('click').on('click', function(){
            let userId = $(this).data('id');
            let userName = $(this).find('.name').clone().children().remove().end().text().trim();

            // Remove active class from all users
            $('.chat-user').removeClass('active');
            $(this).addClass('active');

            receiverId = userId;
            $('#chatWith').html(`<i class="fas fa-user me-2"></i>${userName}`);
            $('#statusDot').show();

            // Clear unread count for this user
            unreadMessages[userId] = 0;

            fetchMessages();
        });
    });
}

// Fetch messages with animation
function fetchMessages(){
    if(!receiverId) return;

    // Show typing indicator briefly
    $('#typingIndicator').show();

    $.get("{{ route('user.chat.fetch') }}", {receiver_id:receiverId}, function(data){
        $('#typingIndicator').hide();

        let chatBox = $('#chatMessages');
        let wasScrolledToBottom = chatBox.scrollTop() + chatBox.innerHeight() >= chatBox[0].scrollHeight - 10;

        // Check for new messages
        let currentCount = currentUserMessages[receiverId] || 0;
        if(data.length > currentCount && currentCount > 0) {
            // Play notification sound for new messages (not on initial load)
            try {
                notificationSound.currentTime = 0;
                notificationSound.play().catch(e => console.log('Could not play sound'));
            } catch(e) {
                console.log('Sound notification not available');
            }
        }

        currentUserMessages[receiverId] = data.length;

        chatBox.html('');
        data.forEach((msg, index) => {
            let cls = msg.sender_id == {{ Auth::id() }} ? 'user' : 'admin';
            let messageTime = new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            setTimeout(() => {
                chatBox.append(`<div class="message ${cls}">
                               ${$('<div>').text(msg.message).html()}
                               <small><i class="fas fa-clock me-1"></i>${messageTime}</small>
                           </div>`);

                if(wasScrolledToBottom) {
                    chatBox.scrollTop(chatBox[0].scrollHeight);
                }
            }, index * 50); // Stagger message appearance
        });

        if(wasScrolledToBottom) {
            setTimeout(() => {
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }, data.length * 50 + 100);
        }
    });
}

// Send message with better UX
$('#sendBtn').on('click', function(){
    let message = $('#chatInput').val().trim();
    if(message === '') return;

    let finalReceiver = receiverId ? receiverId : 1;

    // Disable send button temporarily
    $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

    // Add message immediately to UI for better UX
    if(receiverId) {
        let chatBox = $('#chatMessages');
        let currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        chatBox.append(`<div class="message user">
                       ${$('<div>').text(message).html()}
                       <small><i class="fas fa-clock me-1"></i>${currentTime}</small>
                   </div>`);
        chatBox.scrollTop(chatBox[0].scrollHeight);
    }

    $.post("{{ route('user.chat.send') }}", {
        _token:'{{ csrf_token() }}',
        message: message,
        receiver_id: finalReceiver
    }, () => {
        $('#chatInput').val('').trigger('input');
        $('#sendBtn').prop('disabled', false).html('<i class="fas fa-paper-plane"></i>');

        if(receiverId) {
            setTimeout(fetchMessages, 500); // Small delay to ensure message is saved
        }
        loadUserList();
    }).fail(() => {
        $('#sendBtn').prop('disabled', false).html('<i class="fas fa-paper-plane"></i>');
        // Remove the optimistically added message on failure
        if(receiverId) {
            $('#chatMessages .message.user:last').remove();
        }
    });
});

// Enhanced enter key handling
$('#chatInput').on('keydown', function(e){
    if(e.which === 13 && !e.shiftKey){
        e.preventDefault();
        $('#sendBtn').click();
    }
});

// Auto refresh with smart notification
let refreshInterval = setInterval(function() {
    if(receiverId) {
        // Store current scroll position
        let chatBox = $('#chatMessages');
        let wasScrolledToBottom = chatBox.scrollTop() + chatBox.innerHeight() >= chatBox[0].scrollHeight - 10;

        $.get("{{ route('user.chat.fetch') }}", {receiver_id:receiverId}, function(data){
            let currentCount = currentUserMessages[receiverId] || 0;

            if(data.length > currentCount) {
                // New message received
                if(!wasScrolledToBottom && data.length > currentCount + 1) {
                    // Show notification badge for new message when not at bottom
                    // You can add a "new message" indicator here
                }

                fetchMessages();

                // Play notification sound for admin messages
                if(data.length > 0) {
                    let lastMessage = data[data.length - 1];
                    if(lastMessage.sender_id != {{ Auth::id() }} && data.length > currentCount) {
                        try {
                            notificationSound.currentTime = 0;
                            notificationSound.play().catch(e => console.log('Could not play sound'));
                        } catch(e) {
                            console.log('Sound notification not available');
                        }
                    }
                }
            }
        });
    }

    // Update user list for new messages from other conversations
    loadUserList();
}, 3000);

// Initial load with welcome animation
$(document).ready(function() {
    setTimeout(() => {
        loadUserList();
    }, 300);
});

// Page visibility API for better performance
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        clearInterval(refreshInterval);
    } else {
        refreshInterval = setInterval(function() {
            if(receiverId) fetchMessages();
            loadUserList();
        }, 3000);
    }
});
</script>
@endsection
