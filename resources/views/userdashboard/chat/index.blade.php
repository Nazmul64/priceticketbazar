@extends('userdashboard.master')
@section('content')


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f7fa;
        height: 100vh;
        overflow: hidden;
    }

    .chat-container {
        display: flex;
        height: 100vh;
        background: white;
    }

    /* Left Sidebar */
    .sidebar {
        width: 350px;
        background: white;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        padding: 20px 20px 10px 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar-title {
        font-size: 18px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .sidebar-subtitle {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.4;
    }

    .member-list {
        flex: 1;
        overflow-y: auto;
        padding: 10px 0;
    }

    .member-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        cursor: pointer;
        transition: background-color 0.2s;
        position: relative;
    }

    .member-item:hover {
        background-color: #f9fafb;
    }

    .member-item.active {
        background-color: #eff6ff;
        border-right: 3px solid #3b82f6;
    }

    .member-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        margin-right: 12px;
        object-fit: cover;
    }

    .member-info {
        flex: 1;
        min-width: 0;
    }

    .member-name {
        font-weight: 600;
        color: #374151;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .member-name.blue {
        color: #3b82f6;
    }

    .member-message {
        color: #6b7280;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .member-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
    }

    .member-time {
        font-size: 12px;
        color: #9ca3af;
    }

    .unread-badge {
        background: #ef4444;
        color: white;
        border-radius: 10px;
        padding: 2px 6px;
        font-size: 11px;
        font-weight: 600;
        min-width: 18px;
        text-align: center;
    }

    /* Main Chat Area */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #fefefe;
    }

    .chat-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: linear-gradient(to bottom, #fefefe, #f9fafb);
    }

    .message-group {
        margin-bottom: 24px;
    }

    .message {
        display: flex;
        margin-bottom: 16px;
        align-items: flex-start;
    }

    .message.sent {
        flex-direction: row-reverse;
    }

    .message-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin: 0 12px;
        object-fit: cover;
    }

    .message-content {
        max-width: 70%;
        background: white;
        padding: 12px 16px;
        border-radius: 18px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        position: relative;
    }

    .message.sent .message-content {
        background: #3b82f6;
        color: white;
        border: 1px solid #3b82f6;
    }

    .message-header {
        display: flex;
        align-items: center;
        margin-bottom: 4px;
    }

    .message-sender {
        font-weight: 600;
        font-size: 14px;
        color: #374151;
        margin-right: 8px;
    }

    .message.sent .message-sender {
        color: rgba(255, 255, 255, 0.9);
    }

    .message-time {
        font-size: 11px;
        color: #9ca3af;
    }

    .message.sent .message-time {
        color: rgba(255, 255, 255, 0.7);
    }

    .message-text {
        font-size: 14px;
        line-height: 1.4;
        color: #374151;
    }

    .message.sent .message-text {
        color: white;
    }

    /* Chat Input */
    .chat-input-container {
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        background: white;
    }

    .chat-input-wrapper {
        display: flex;
        align-items: center;
        background: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 24px;
        padding: 8px 16px;
        transition: all 0.2s;
    }

    .chat-input-wrapper:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .chat-input {
        flex: 1;
        border: none;
        background: none;
        outline: none;
        font-size: 14px;
        padding: 8px 0;
        color: #374151;
    }

    .chat-input::placeholder {
        color: #9ca3af;
    }

    .send-button {
        background: #3b82f6;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-left: 8px;
    }

    .send-button:hover {
        background: #2563eb;
    }

    .send-button:disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    .send-icon {
        width: 16px;
        height: 16px;
        fill: white;
    }

    /* Typing Indicator */
    .typing-indicator {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
        opacity: 0;
        animation: fadeIn 0.3s ease-in-out forwards;
    }

    .typing-indicator .message-avatar {
        margin-right: 12px;
    }

    .typing-content {
        background: white;
        padding: 12px 16px;
        border-radius: 18px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
    }

    .typing-text {
        font-size: 13px;
        color: #6b7280;
        margin-right: 8px;
    }

    .typing-dots {
        display: flex;
        gap: 3px;
    }

    .typing-dot {
        width: 4px;
        height: 4px;
        background: #9ca3af;
        border-radius: 50%;
        animation: typing 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typing {
        0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
        40% { transform: scale(1); opacity: 1; }
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: absolute;
            left: -100%;
            transition: left 0.3s;
            z-index: 100;
        }

        .sidebar.open {
            left: 0;
        }
    }
</style>



<div class="chat-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-title">{{ __('Chat window') }}</h2>
            <p class="sidebar-subtitle">{{ __('A bigger chat window would be a perfect fit for chat rooms and group chat apps.') }}</p>
        </div>

        <div class="member-list" id="memberList">
            @php
                $members = [
                    [
                        'id' => 'john',
                        'name' => 'John Doe',
                        'message' => 'Hello, Are you there?',
                        'time' => 'Just now',
                        'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
                        'unread' => 1,
                        'active' => true,
                        'blue' => true
                    ],
                    [
                        'id' => 'danny',
                        'name' => 'Danny Smith',
                        'message' => 'Lorem ipsum dolor sit.',
                        'time' => '5 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
                        'unread' => 0,
                        'active' => false,
                        'blue' => true
                    ],
                    [
                        'id' => 'alex',
                        'name' => 'Alex Steward',
                        'message' => 'Lorem ipsum dolor sit.',
                        'time' => 'Yesterday',
                        'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
                        'unread' => 0,
                        'active' => false,
                        'blue' => true
                    ],
                    [
                        'id' => 'ashley',
                        'name' => 'Ashley Olsen',
                        'message' => 'Lorem ipsum dolor sit.',
                        'time' => 'Yesterday',
                        'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face',
                        'unread' => 0,
                        'active' => false,
                        'blue' => false
                    ],
                    [
                        'id' => 'kate',
                        'name' => 'Kate Moss',
                        'message' => 'Lorem ipsum dolor sit.',
                        'time' => 'Yesterday',
                        'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=face',
                        'unread' => 0,
                        'active' => false,
                        'blue' => true
                    ],
                    [
                        'id' => 'lara',
                        'name' => 'Lara Croft',
                        'message' => 'Lorem ipsum dolor sit.',
                        'time' => 'Yesterday',
                        'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop&crop=face',
                        'unread' => 0,
                        'active' => false,
                        'blue' => false
                    ],
                    [
                        'id' => 'brad',
                        'name' => 'Brad Pitt',
                        'message' => 'Lorem ipsum dolor sit.',
                        'time' => '5 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face',
                        'unread' => 0,
                        'active' => false,
                        'blue' => false
                    ]
                ];
            @endphp

            @foreach($members as $member)
                <div class="member-item {{ $member['active'] ? 'active' : '' }}" data-user="{{ $member['id'] }}">
                    <img src="{{ $member['avatar'] }}" alt="{{ $member['name'] }}" class="member-avatar">
                    <div class="member-info">
                        <div class="member-name {{ $member['blue'] ? 'blue' : '' }}">{{ $member['name'] }}</div>
                        <div class="member-message">{{ $member['message'] }}</div>
                    </div>
                    <div class="member-meta">
                        <div class="member-time">{{ $member['time'] }}</div>
                        @if($member['unread'] > 0)
                            <div class="unread-badge">{{ $member['unread'] }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Chat Main -->
    <div class="chat-main">
        <div class="chat-messages" id="chatMessages">
            @php
                $messages = [
                    [
                        'sender' => 'Brad Pitt',
                        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'time' => '12 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face',
                        'sent' => false
                    ],
                    [
                        'sender' => 'Lara Croft',
                        'text' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
                        'time' => '13 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop&crop=face',
                        'sent' => false
                    ],
                    [
                        'sender' => 'You',
                        'text' => 'Thank you for the information. That was very helpful!',
                        'time' => '11 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&h=150&fit=crop&crop=face',
                        'sent' => true
                    ],
                    [
                        'sender' => 'Brad Pitt',
                        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'time' => '10 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face',
                        'sent' => false
                    ],
                    [
                        'sender' => 'You',
                        'text' => 'Perfect! I understand now. Let me know if you need anything else.',
                        'time' => '8 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&h=150&fit=crop&crop=face',
                        'sent' => true
                    ],
                    [
                        'sender' => 'Lara Croft',
                        'text' => 'Great! Happy to help you anytime.',
                        'time' => '5 mins ago',
                        'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop&crop=face',
                        'sent' => false
                    ]
                ];
            @endphp

            @foreach($messages as $message)
                <div class="message-group">
                    <div class="message {{ $message['sent'] ? 'sent' : '' }}">
                        <img src="{{ $message['avatar'] }}" alt="{{ $message['sender'] }}" class="message-avatar">
                        <div class="message-content">
                            <div class="message-header">
                                <span class="message-sender">{{ $message['sender'] }}</span>
                                <span class="message-time">{{ $message['time'] }}</span>
                            </div>
                            <div class="message-text">{{ $message['text'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="chat-input-container">
            <div class="chat-input-wrapper">
                <input type="text" class="chat-input" placeholder="{{ __('Message') }}" id="messageInput">
                <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
                <button class="send-button" id="sendButton">
                    <svg class="send-icon" viewBox="0 0 24 24">
                        <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let typingTimeout;
    let currentUser = 'john';

    // Sample user data
    const users = {
        john: {
            name: 'John Doe',
            avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
            messages: [
                { text: 'Hello, Are you there?', time: 'Just now', sender: 'John Doe' }
            ]
        },
        danny: {
            name: 'Danny Smith',
            avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
            messages: []
        },
        alex: {
            name: 'Alex Steward',
            avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
            messages: []
        },
        ashley: {
            name: 'Ashley Olsen',
            avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face',
            messages: []
        },
        kate: {
            name: 'Kate Moss',
            avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=face',
            messages: []
        },
        lara: {
            name: 'Lara Croft',
            avatar: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop&crop=face',
            messages: []
        },
        brad: {
            name: 'Brad Pitt',
            avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face',
            messages: []
        }
    };

    // Member item click handler
    document.querySelectorAll('.member-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.member-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            currentUser = this.dataset.user;

            // Remove unread badge
            const badge = this.querySelector('.unread-badge');
            if (badge) badge.remove();

            loadChatMessages();
        });
    });

    // Input handlers
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const chatMessages = document.getElementById('chatMessages');
    const csrfToken = document.getElementById('csrfToken').value;

    messageInput.addEventListener('input', function() {
        sendButton.disabled = !this.value.trim();

        // Show typing indicator
        showTypingIndicator();

        // Clear existing timeout
        clearTimeout(typingTimeout);

        // Set new timeout to hide typing indicator
        typingTimeout = setTimeout(hideTypingIndicator, 2000);
    });

    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    sendButton.addEventListener('click', sendMessage);

    async function sendMessage() {
        const message = messageInput.value.trim();
        if (!message) return;

        hideTypingIndicator();

        // Add sent message to UI immediately
        addMessage(message, true);

        messageInput.value = '';
        sendButton.disabled = true;

        try {
            // Send message to server (uncomment when you have backend ready)
            /*
            const response = await fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: message,
                    receiver_id: currentUser,
                    chat_room_id: 1
                })
            });

            const result = await response.json();

            if (result.success) {
                console.log('Message sent successfully');
            } else {
                console.error('Failed to send message:', result.message);
            }
            */
        } catch (error) {
            console.error('Error sending message:', error);
        }

        // Simulate reply after delay
        setTimeout(() => {
            showTypingIndicator();
            setTimeout(() => {
                hideTypingIndicator();
                addMessage('We are checking your issue.', false);
            }, 2000);
        }, 1000);
    }

    function addMessage(text, sent = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message-group';

        const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        const userData = users[currentUser] || { name: 'Unknown', avatar: '' };

        messageDiv.innerHTML = `
            <div class="message${sent ? ' sent' : ''}">
                <img src="${sent ? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&h=150&fit=crop&crop=face' : userData.avatar}" alt="Avatar" class="message-avatar">
                <div class="message-content">
                    <div class="message-header">
                        <span class="message-sender">${sent ? 'You' : userData.name}</span>
                        <span class="message-time">${currentTime}</span>
                    </div>
                    <div class="message-text">${escapeHtml(text)}</div>
                </div>
            </div>
        `;

        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showTypingIndicator() {
        hideTypingIndicator(); // Remove existing

        const userData = users[currentUser] || { name: 'Unknown', avatar: '' };
        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.id = 'typingIndicator';
        typingDiv.innerHTML = `
            <img src="${userData.avatar}" alt="Avatar" class="message-avatar">
            <div class="typing-content">
                <span class="typing-text">${userData.name} is typing</span>
                <div class="typing-dots">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `;

        chatMessages.appendChild(typingDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function hideTypingIndicator() {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) {
            indicator.remove();
        }
    }

    function loadChatMessages() {
        // This function would load messages for the selected user from server
        // For now, just scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Initialize
    sendButton.disabled = true;

    // Auto-scroll to bottom on page load
    document.addEventListener('DOMContentLoaded', function() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });
</script>
@endsection
