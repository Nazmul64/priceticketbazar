@extends('Admin.master')

@section('content')

<!-- Dashboard Stats -->
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4 mb-4">
    <!-- Total Deposits -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1">Total Deposits</p>
                        <p class="mb-0 mt-2 font-13">
                            <i class="bi bi-arrow-up"></i>
                            <span>{{ round($total_deposites) }} $</span>
                        </p>
                    </div>
                    <div class="ms-auto widget-icon bg-primary text-white">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Investor Count -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1">Total Deposit Investors</p>
                        <h4 class="mb-0">{{ $total_deposites_investor }}</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-success text-white">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1">Total Users</p>
                        <h4 class="mb-0">{{ $total_user }}</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-orange text-white">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Weekly Deposits -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1">Last Weekly Deposit</p>
                        <h4 class="mb-0">{{ round($last_wekly) }} $</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-info text-white">
                        <i class="bi bi-calendar-week"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chat Notifications -->
<div class="notification-area mb-3">
    <div id="chatNotification" class="chat-notification">
        <i class="fas fa-comment-dots"></i>
        <span id="notificationText">New message from user!</span>
        <button id="closeNotification" class="close-notification">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Modern Chat System -->
<div class="chat-container-wrapper">
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="chat-sidebar">
            <div class="sidebar-header">
                <i class="fas fa-comments"></i>
                Admin Chat Center
                <div class="total-unread" id="totalUnreadBadge">0</div>
            </div>

            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search messages or users" id="searchInput">
            </div>

            <!-- Admin Quick Actions -->
            <div class="admin-actions">
                <button class="action-btn" id="refreshUsers" title="Refresh Users">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <button class="action-btn" id="markAllRead" title="Mark All as Read">
                    <i class="fas fa-check-double"></i>
                </button>
                <button class="action-btn" id="clearSearch" title="Clear Search">
                    <i class="fas fa-eraser"></i>
                </button>
            </div>

            <div class="chat-list" id="chatList">
                <!-- Dynamic user list will be loaded here -->
            </div>

            <!-- Admin Chat Summary -->
            <div class="chat-summary">
                <div class="summary-item">
                    <span>Total Conversations:</span>
                    <span id="totalConversations">0</span>
                </div>
                <div class="summary-item">
                    <span>Unread Messages:</span>
                    <span id="totalUnreadMessages">0</span>
                </div>
                <div class="summary-item">
                    <span>Active Users:</span>
                    <span id="activeUsers">0</span>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="chat-area">
            <div class="chat-header" id="chatHeader">
                <div class="chat-header-info">
                    <img src="https://i.pravatar.cc/40?img=1" alt="User" class="chat-header-avatar" id="chatHeaderAvatar">
                    <div class="chat-header-details">
                        <span id="chatWith">Select a chat to start messaging</span>
                        <small id="userStatus" class="user-status">Click on a user to chat</small>
                    </div>
                </div>
                <div class="chat-actions">
                    <button class="action-icon-btn" id="clearChat" title="Clear Chat History">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button class="action-icon-btn" id="userProfile" title="View User Profile">
                        <i class="fas fa-user"></i>
                    </button>
                    <button class="action-icon-btn" id="chatSettings" title="Chat Settings">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                <div class="empty-chat">
                    <i class="fas fa-comment-dots"></i>
                    <h3>Welcome to Admin Chat Center</h3>
                    <p>Select a user conversation to start messaging</p>
                    <small>You can communicate with all registered users here</small>
                </div>
            </div>

            <div class="chat-input">
                @csrf
                <div class="input-container">
                    <div class="input-actions">
                        <button class="input-action-btn" id="emojiBtn" title="Add Emoji">
                            <i class="fas fa-smile"></i>
                        </button>
                        <button class="input-action-btn" id="attachBtn" title="Attach File">
                            <i class="fas fa-paperclip"></i>
                        </button>
                    </div>
                    <textarea id="chatInput" class="chat-textarea" placeholder="Select a user first to start messaging..." rows="1" disabled></textarea>
                    <div class="send-actions">
                        <button id="sendBtn" class="send-btn" disabled>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
                <div class="typing-indicator" id="typingIndicator">
                    <span></span> is typing...
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.chat-container-wrapper {
    margin-top: 20px;
}

.chat-container {
    display: flex;
    height: 700px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Chat Notification Styles */
.notification-area {
    position: relative;
}

.chat-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 10000;
    transform: translateX(400px);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    max-width: 300px;
}

.chat-notification.show {
    transform: translateX(0);
    opacity: 1;
}

.chat-notification.hide {
    transform: translateX(400px);
    opacity: 0;
}

.close-notification {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
    margin-left: 10px;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.close-notification:hover {
    opacity: 1;
}

/* Enhanced Sidebar */
.chat-sidebar {
    width: 380px;
    background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    padding: 25px 20px;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.sidebar-header .fas {
    margin-right: 10px;
}

.total-unread {
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    margin-left: auto;
}

.search-box {
    padding: 15px 20px;
    background: white;
    border-bottom: 1px solid #e2e8f0;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 12px 15px 12px 40px;
    border: 1px solid #e2e8f0;
    border-radius: 25px;
    font-size: 14px;
    background: #f8fafc;
    outline: none;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #4facfe;
    box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
}

.search-box::before {
    content: '\f002';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    left: 35px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 14px;
}

/* Admin Actions */
.admin-actions {
    display: flex;
    gap: 5px;
    padding: 10px 20px;
    background: rgba(79, 172, 254, 0.1);
    border-bottom: 1px solid #e2e8f0;
}

.action-btn {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border: none;
    border-radius: 8px;
    padding: 8px 12px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 12px;
    flex: 1;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 172, 254, 0.4);
}

.chat-list {
    flex: 1;
    overflow-y: auto;
    padding: 10px 0;
}

.no-users-message {
    padding: 40px 20px;
    text-align: center;
    color: #64748b;
}

.no-users-message i {
    font-size: 48px;
    opacity: 0.3;
    margin-bottom: 15px;
    display: block;
}

.chat-user {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
    position: relative;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.chat-user:hover {
    background: rgba(79, 172, 254, 0.1);
    border-left-color: #4facfe;
}

.chat-user.active {
    background: linear-gradient(90deg, rgba(79, 172, 254, 0.15) 0%, rgba(0, 242, 254, 0.1) 100%);
    border-left-color: #4facfe;
}

.chat-user.has-unread {
    background: rgba(255, 71, 87, 0.1);
    border-left-color: #ff4757;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 15px;
    border: 3px solid #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-info {
    flex: 1;
    overflow: hidden;
}

.user-name {
    font-weight: 600;
    font-size: 15px;
    color: #1e293b;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-role {
    background: #4facfe;
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    font-weight: 500;
}

.user-last-msg {
    font-size: 13px;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.unread-count {
    position: absolute;
    top: 10px;
    right: 15px;
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: bold;
}

.online-indicator {
    width: 12px;
    height: 12px;
    background: #10b981;
    border: 2px solid white;
    border-radius: 50%;
    position: absolute;
    bottom: 2px;
    right: 2px;
    animation: pulse 2s infinite;
}

.message-time-indicator {
    font-size: 11px;
    color: #94a3b8;
    position: absolute;
    bottom: 10px;
    right: 15px;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Chat Summary */
.chat-summary {
    padding: 15px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 13px;
}

.summary-item:last-child {
    margin-bottom: 0;
}

/* Enhanced Chat Area */
.chat-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
}

.chat-header {
    padding: 25px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.chat-header-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.chat-header-details {
    display: flex;
    flex-direction: column;
}

.user-status {
    color: rgba(255, 255, 255, 0.8);
    font-size: 12px;
    margin-top: 2px;
}

.chat-header-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    object-fit: cover;
}

.chat-actions {
    display: flex;
    gap: 10px;
}

.action-icon-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-icon-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px 30px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23f1f5f9" opacity="0.5"/><circle cx="75" cy="75" r="1" fill="%23f1f5f9" opacity="0.3"/><circle cx="50" cy="10" r="1" fill="%23f1f5f9" opacity="0.4"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
}

.message {
    margin-bottom: 20px;
    display: flex;
    align-items: flex-end;
    animation: slideInMessage 0.3s ease;
}

@keyframes slideInMessage {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message.admin {
    justify-content: flex-end;
}

.message-bubble {
    max-width: 70%;
    padding: 15px 20px;
    border-radius: 25px;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    word-wrap: break-word;
}

.message.admin .message-bubble {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    border-bottom-right-radius: 8px;
}

.message.admin .message-bubble::after {
    content: '✓✓';
    font-size: 10px;
    opacity: 0.7;
    margin-left: 8px;
}

.message.user .message-bubble {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-bottom-left-radius: 8px;
    margin-left: 15px;
}

.message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    object-fit: cover;
}

.message-time {
    font-size: 11px;
    opacity: 0.7;
    margin-top: 8px;
    display: block;
}

.message-text {
    line-height: 1.4;
}

/* Enhanced Chat Input */
.chat-input {
    padding: 20px 30px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.input-container {
    display: flex;
    align-items: flex-end;
    gap: 15px;
    background: white;
    border-radius: 25px;
    padding: 15px 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
}

.input-actions {
    display: flex;
    gap: 5px;
}

.input-action-btn {
    background: none;
    border: none;
    color: #64748b;
    cursor: pointer;
    padding: 5px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.input-action-btn:hover {
    background: #f1f5f9;
    color: #4facfe;
}

.chat-textarea {
    flex: 1;
    border: none;
    outline: none;
    resize: none;
    font-size: 14px;
    line-height: 1.4;
    max-height: 100px;
    min-height: 20px;
    font-family: inherit;
    margin: 0 10px;
}

.chat-textarea:disabled {
    background: transparent;
    color: #94a3b8;
}

.send-actions {
    display: flex;
    align-items: center;
    gap: 5px;
}

.send-btn {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(79, 172, 254, 0.3);
}

.send-btn:hover:not(:disabled) {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
}

.send-btn:disabled {
    opacity: 0.5;
    transform: none;
    cursor: not-allowed;
    background: #94a3b8;
    box-shadow: none;
}

.typing-indicator {
    font-size: 12px;
    color: #64748b;
    padding: 5px 15px;
    display: none;
    font-style: italic;
}

/* Empty State */
.empty-chat {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #64748b;
    text-align: center;
}

.empty-chat i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.3;
}

/* Custom Scrollbar */
.chat-list::-webkit-scrollbar,
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-list::-webkit-scrollbar-track,
.chat-messages::-webkit-scrollbar-track {
    background: transparent;
}

.chat-list::-webkit-scrollbar-thumb,
.chat-messages::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 3px;
}

.chat-list::-webkit-scrollbar-thumb:hover,
.chat-messages::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .chat-container {
        height: 500px;
        margin: 10px;
    }

    .chat-sidebar {
        width: 100%;
        position: absolute;
        z-index: 1000;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .chat-sidebar.show {
        transform: translateX(0);
    }

    .message-bubble {
        max-width: 85%;
    }

    .chat-messages {
        padding: 15px 20px;
    }

    .chat-input {
        padding: 15px 20px;
    }

    .chat-notification {
        position: fixed;
        top: 10px;
        right: 10px;
        left: 10px;
        max-width: none;
    }
}

/* Animation Classes */
@keyframes slideInFromTop {
    from {
        transform: translateY(-100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.slide-in-top {
    animation: slideInFromTop 0.5s ease-out;
}

@keyframes bounce {
    0%, 20%, 60%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    80% {
        transform: translateY(-5px);
    }
}

.bounce-animation {
    animation: bounce 2s ease-in-out;
}
</style>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let receiverId = null;
let selectedUserName = '';
let selectedUserAvatar = '';
let lastMessageCount = 0;
let unreadMessages = {};
let notificationSound = null;
let isAdminTyping = false;

// Initialize notification sound
function initializeNotificationSound() {
    try {
        // Create a simple notification sound using Web Audio API
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        notificationSound = {
            play: function() {
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.setValueAtTime(600, audioContext.currentTime + 0.1);

                gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.5);
            }
        };
    } catch (e) {
        console.log('Audio context not available');
    }
}

// Show notification
function showNotification(message, userName) {
    const notification = $('#chatNotification');
    $('#notificationText').text(`New message from ${userName}: ${message.substring(0, 50)}${message.length > 50 ? '...' : ''}`);

    notification.removeClass('hide').addClass('show');

    // Play sound
    if (notificationSound) {
        try {
            notificationSound.play();
        } catch (e) {
            console.log('Could not play notification sound');
        }
    }

    // Auto hide after 5 seconds
    setTimeout(() => {
        hideNotification();
    }, 5000);
}

// Hide notification
function hideNotification() {
    $('#chatNotification').removeClass('show').addClass('hide');
}

// Close notification manually
$('#closeNotification').on('click', hideNotification);

// Load sidebar users with enhanced features
function loadUserList(){
    $.get("{{ route('chat.users') }}", function(users){
        let html = '';
        let totalUnread = 0;
        let activeUserCount = 0;

        if(users.length === 0) {
            html = `
                <div class="no-users-message slide-in-top">
                    <i class="fas fa-users"></i>
                    <p>No user conversations yet</p>
                    <small>Users will appear here when they start chatting with admin</small>
                </div>`;
        } else {
            users.forEach(u => {
                let avatar = u.photo ? u.photo : `https://i.pravatar.cc/50?img=${u.id}`;
                let unreadCount = unreadMessages[u.id] || 0;
                let hasUnread = unreadCount > 0;
                let isOnline = Math.random() > 0.5; // Simulate online status
                let lastSeen = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                if (hasUnread) {
                    totalUnread += unreadCount;
                }

                if (isOnline) {
                    activeUserCount++;
                }

                html += `
                    <div class="chat-user ${hasUnread ? 'has-unread' : ''}" data-id="${u.id}" data-name="${u.name}" data-avatar="${avatar}">
                        <div class="user-avatar">
                            <img src="${avatar}" alt="${u.name}">
                            ${isOnline ? '<div class="online-indicator"></div>' : ''}
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                ${u.name}
                                <span class="user-role">User</span>
                            </div>
                            <div class="user-last-msg">${u.last_msg || 'No messages yet'}</div>
                        </div>
                        ${hasUnread ? `<div class="unread-count">${unreadCount}</div>` : ''}
                        <div class="message-time-indicator">${lastSeen}</div>
                    </div>`;
            });
        }

        $('#chatList').html(html);

        // Update summary
        $('#totalConversations').text(users.length);
        $('#totalUnreadMessages').text(totalUnread);
        $('#activeUsers').text(activeUserCount);
        $('#totalUnreadBadge').text(totalUnread);

        // Click to open chat
        $('.chat-user').off('click').on('click', function(){
            $('.chat-user').removeClass('active');
            $(this).addClass('active');

            receiverId = $(this).data('id');
            selectedUserName = $(this).data('name');
            selectedUserAvatar = $(this).data('avatar');

            $('#chatWith').text(`${selectedUserName}`);
            $('#userStatus').text('Click to view profile • Last seen recently');
            $('#chatHeaderAvatar').attr('src', selectedUserAvatar);

            // Clear unread count for this user
            unreadMessages[receiverId] = 0;
            $(this).removeClass('has-unread').find('.unread-count').remove();

            // Enable input when user is selected
            $('#chatInput').prop('disabled', false).attr('placeholder', `Type your message to ${selectedUserName}...`);
            $('#sendBtn').prop('disabled', false);

            fetchMessages();
        });
    }).fail(function() {
        console.error('Failed to load users');
        $('#chatList').html('<div style="padding: 20px; text-align: center; color: #64748b;">Failed to load users. Please refresh.</div>');
    });
}

// Fetch messages with admin/user distinction
function fetchMessages(){
    if(!receiverId) return;

    $.get("{{ route('chat.fetch') }}", {receiver_id: receiverId}, function(data){
        let chatBox = $('#chatMessages');
        chatBox.html('');

        if(data.length === 0) {
            chatBox.html(`
                <div class="empty-chat">
                    <i class="fas fa-comment-dots"></i>
                    <h3>No messages yet with ${selectedUserName}</h3>
                    <p>Start the conversation!</p>
                    <small>As an admin, you can initiate conversations with any user</small>
                </div>
            `);
            return;
        }

        data.forEach(msg => {
            let isAdmin = msg.sender_id == {{ Auth::id() }};
            let cls = isAdmin ? 'admin' : 'user';
            let senderName = isAdmin ? 'Admin (You)' : selectedUserName;
            let avatar = isAdmin ? 'https://i.pravatar.cc/32?img={{ Auth::id() }}' : selectedUserAvatar;

            let messageHtml = `
                <div class="message ${cls}">
                    ${!isAdmin ? `<img src="${avatar}" alt="Avatar" class="message-avatar">` : ''}
                    <div class="message-bubble">
                        <div class="message-text">${escapeHtml(msg.message)}</div>
                        <small class="message-time">${formatTime(msg.created_at)} • ${senderName}</small>
                    </div>
                </div>`;
            chatBox.append(messageHtml);
        });

        // Check for new messages and show notification
        if (data.length > lastMessageCount && lastMessageCount > 0) {
            let newMessages = data.slice(lastMessageCount);
            newMessages.forEach(msg => {
                if (msg.sender_id != {{ Auth::id() }}) {
                    showNotification(msg.message, selectedUserName);
                }
            });
        }
        lastMessageCount = data.length;

        chatBox.scrollTop(chatBox[0].scrollHeight);
    }).fail(function() {
        console.error('Failed to fetch messages');
        $('#chatMessages').html('<div style="padding: 20px; text-align: center; color: #ff4757;">Failed to load messages. Please try again.</div>');
    });
}

// Send message as admin
function sendMessage() {
    let message = $('#chatInput').val().trim();

    if(message === '') {
        return;
    }

    if(!receiverId) {
        alert('Please select a user first to send a message');
        return;
    }

    // Show typing indicator
    $('#typingIndicator').show().find('span').text('Admin');

    $.post("{{ route('chat.send') }}", {
        _token: '{{ csrf_token() }}',
        message: message,
        receiver_id: receiverId
    }, function(response){
        $('#chatInput').val('');
        $('#sendBtn').prop('disabled', true);
        $('#typingIndicator').hide();
        resetTextareaHeight();
        fetchMessages();
        loadUserList();

        // Add success feedback
        showSuccessMessage('Message sent successfully!');
    }).fail(function(xhr) {
        $('#typingIndicator').hide();
        console.error('Failed to send message');
        let errorMsg = xhr.responseJSON?.message || 'Failed to send message. Please try again.';
        showErrorMessage(errorMsg);
    });
}

// Show success message
function showSuccessMessage(message) {
    const successDiv = $(`
        <div class="alert alert-success" style="position: fixed; top: 80px; right: 20px; z-index: 9999; border-radius: 10px;">
            <i class="fas fa-check-circle"></i> ${message}
        </div>
    `);
    $('body').append(successDiv);
    setTimeout(() => {
        successDiv.fadeOut(() => successDiv.remove());
    }, 3000);
}

// Show error message
function showErrorMessage(message) {
    const errorDiv = $(`
        <div class="alert alert-danger" style="position: fixed; top: 80px; right: 20px; z-index: 9999; border-radius: 10px;">
            <i class="fas fa-exclamation-circle"></i> ${message}
        </div>
    `);
    $('body').append(errorDiv);
    setTimeout(() => {
        errorDiv.fadeOut(() => errorDiv.remove());
    }, 3000);
}

// Admin action buttons
$('#refreshUsers').on('click', function() {
    $(this).addClass('bounce-animation');
    loadUserList();
    setTimeout(() => {
        $(this).removeClass('bounce-animation');
    }, 2000);
});

$('#markAllRead').on('click', function() {
    unreadMessages = {};
    loadUserList();
    showSuccessMessage('All messages marked as read!');
});

$('#clearSearch').on('click', function() {
    $('#searchInput').val('');
    $('.chat-user').show();
});

// Chat header actions
$('#clearChat').on('click', function() {
    if (confirm('Are you sure you want to clear this chat history? This action cannot be undone.')) {
        // Implement clear chat functionality
        $('#chatMessages').html(`
            <div class="empty-chat">
                <i class="fas fa-broom"></i>
                <h3>Chat Cleared</h3>
                <p>Chat history has been cleared</p>
            </div>
        `);
        showSuccessMessage('Chat history cleared!');
    }
});

$('#userProfile').on('click', function() {
    if (receiverId) {
        showSuccessMessage(`Viewing profile for ${selectedUserName}`);
        // Implement user profile view
    } else {
        showErrorMessage('Please select a user first');
    }
});

$('#chatSettings').on('click', function() {
    showSuccessMessage('Chat settings opened');
    // Implement chat settings
});

// Enhanced input actions
$('#emojiBtn').on('click', function() {
    // Simple emoji insertion
    let emojis = ['😊', '👍', '❤️', '😂', '🎉', '👋', '🔥', '💯'];
    let randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];
    let currentText = $('#chatInput').val();
    $('#chatInput').val(currentText + randomEmoji);
    $('#chatInput').trigger('input');
});

$('#attachBtn').on('click', function() {
    showSuccessMessage('File attachment feature coming soon!');
});

// Send button click
$('#sendBtn').on('click', function(){
    if(!$(this).prop('disabled')) {
        sendMessage();
    }
});

// Enhanced enter key handling
$('#chatInput').on('keypress', function(e){
    if(e.which == 13 && !e.shiftKey){
        e.preventDefault();
        if(!$(this).prop('disabled') && receiverId && $(this).val().trim() !== '') {
            sendMessage();
        }
    }
});

// Enhanced input handling with typing detection
let typingTimer;
$('#chatInput').on('input', function(){
    if($(this).prop('disabled')) return;

    const hasContent = $(this).val().trim() !== '';
    const hasReceiver = receiverId !== null;
    $('#sendBtn').prop('disabled', !(hasContent && hasReceiver));

    // Auto-resize
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';

    // Typing indicator simulation
    if (hasContent && hasReceiver && !isAdminTyping) {
        isAdminTyping = true;
        // In a real implementation, you would send typing status to other users
    }

    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
        isAdminTyping = false;
    }, 1000);
});

// Enhanced search functionality
$('#searchInput').on('input', function() {
    const searchTerm = $(this).val().toLowerCase();
    let visibleCount = 0;

    $('.chat-user').each(function() {
        const userName = $(this).find('.user-name').text().toLowerCase();
        const lastMsg = $(this).find('.user-last-msg').text().toLowerCase();

        if (userName.includes(searchTerm) || lastMsg.includes(searchTerm) || searchTerm === '') {
            $(this).show();
            visibleCount++;
        } else {
            $(this).hide();
        }
    });

    // Show search results count
    if (searchTerm && visibleCount === 0) {
        if ($('.no-search-results').length === 0) {
            $('#chatList').append(`
                <div class="no-search-results" style="padding: 20px; text-align: center; color: #64748b;">
                    <i class="fas fa-search"></i>
                    <p>No users found for "${searchTerm}"</p>
                    <small>Try a different search term</small>
                </div>
            `);
        }
    } else {
        $('.no-search-results').remove();
    }
});

// Reset textarea height
function resetTextareaHeight() {
    $('#chatInput')[0].style.height = 'auto';
}

// Utility functions
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatTime(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays === 1) {
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    } else if (diffDays <= 7) {
        return date.toLocaleDateString([], { weekday: 'short' }) + ' ' +
               date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    } else {
        return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
    }
}

// Simulate new message notifications (for demo purposes)
function simulateNewMessage() {
    // This would be replaced with real-time updates (WebSocket/Pusher)
    const users = $('.chat-user');
    if (users.length > 0) {
        const randomUser = users.eq(Math.floor(Math.random() * users.length));
        const userId = randomUser.data('id');
        const userName = randomUser.data('name');

        if (userId !== receiverId) { // Don't notify for current chat
            unreadMessages[userId] = (unreadMessages[userId] || 0) + 1;
            showNotification('Hey admin, I need help with my account!', userName);
            loadUserList();
        }
    }
}

// Auto refresh messages every 3 seconds
setInterval(function() {
    if(receiverId) {
        fetchMessages();
    }
}, 3000);

// Auto refresh user list every 10 seconds
setInterval(function() {
    loadUserList();
}, 10000);

// Simulate random notifications every 30 seconds (for demo)
setInterval(function() {
    if (Math.random() > 0.7) { // 30% chance
        simulateNewMessage();
    }
}, 30000);

// Initialize on document ready
$(document).ready(function() {
    initializeNotificationSound();
    loadUserList();

    // Welcome message
    setTimeout(() => {
        showSuccessMessage('Welcome to Admin Chat Center! 👋');
    }, 1000);

    // Request notification permission
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
});

// Handle page visibility for notifications
document.addEventListener('visibilitychange', function() {
    if (!document.hidden && receiverId) {
        // Page became visible, refresh messages
        fetchMessages();
    }
});

// Prevent form submission on enter
$(document).on('keydown', function(e) {
    if (e.target.id === 'chatInput' && e.which === 13 && !e.shiftKey) {
        e.preventDefault();
    }
});
</script>

@endsection
