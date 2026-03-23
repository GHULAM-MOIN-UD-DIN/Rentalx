{{-- resources/views/Admin/chat.blade.php --}}
@extends('adminlayout.app')

@section('title', 'Chat Inbox')

@push('styles')
<style>
/* ===== ADMIN CHAT FULL-SCREEN OVERRIDE ===== */
.admin-chat-page {
    display: flex;
    height: calc(100vh - 80px);
    overflow: hidden;
    gap: 0;
    background: rgba(0,0,0,0.3);
    border-radius: 16px;
    border: 1px solid rgba(239,68,68,0.15);
    overflow: hidden;
}

/* ===== USER LIST SIDEBAR ===== */
.user-list-panel {
    width: 320px;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    background: rgba(10,10,10,0.8);
    border-right: 1px solid rgba(239,68,68,0.15);
    backdrop-filter: blur(20px);
}

.panel-header {
    padding: 16px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    flex-shrink: 0;
}

.panel-header h2 {
    font-size: 1.1rem;
    font-weight: 800;
    background: linear-gradient(135deg, #fff, #ef4444);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 10px;
}

.search-box {
    position: relative;
}
.search-box input {
    width: 100%;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 8px 14px 8px 36px;
    color: white;
    font-size: 0.8rem;
    outline: none;
    transition: border-color 0.3s;
}
.search-box input:focus { border-color: rgba(239,68,68,0.4); }
.search-box input::placeholder { color: #555; }
.search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #555; font-size: 0.8rem; }

.user-list {
    flex: 1;
    overflow-y: auto;
}
.user-list::-webkit-scrollbar { width: 3px; }
.user-list::-webkit-scrollbar-thumb { background: rgba(239,68,68,0.2); border-radius: 2px; }

.user-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    cursor: pointer;
    transition: all 0.2s;
    border-bottom: 1px solid rgba(255,255,255,0.03);
    position: relative;
}
.user-item:hover { background: rgba(239,68,68,0.07); }
.user-item.active { background: rgba(239,68,68,0.12); border-left: 3px solid #ef4444; }

.user-item-avatar {
    width: 44px; height: 44px; border-radius: 50%;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 0.85rem; color: white;
    flex-shrink: 0; position: relative; overflow: hidden;
    border: 1.5px solid rgba(239,68,68,0.3);
}
.user-item-avatar img { width: 100%; height: 100%; object-fit: cover; }

.status-dot {
    position: absolute; bottom: 1px; right: 1px;
    width: 10px; height: 10px; border-radius: 50%;
    border: 2px solid #0a0a0a;
    background: #22c55e;
    transition: background 0.3s;
}
.status-dot.offline { background: #4b5563; }

.user-item-info { flex: 1; min-width: 0; }
.user-item-name { font-size: 0.88rem; font-weight: 700; color: #e5e5e5; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.user-item-preview { font-size: 0.72rem; color: #666; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px; }
.user-item-time { font-size: 0.62rem; color: #555; flex-shrink: 0; }

.unread-badge {
    position: absolute; top: 14px; right: 16px;
    background: #ef4444; color: white;
    font-size: 0.62rem; font-weight: 700;
    min-width: 18px; height: 18px; border-radius: 999px;
    display: flex; align-items: center; justify-content: center;
    padding: 0 4px;
}

/* ===== CONVERSATION PANEL ===== */
.conversation-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: #0d0d0d;
    background-image: radial-gradient(ellipse at 80% 20%, rgba(239,68,68,0.03) 0%, transparent 60%);
}

.conv-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    background: rgba(15,15,15,0.9);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    flex-shrink: 0;
    backdrop-filter: blur(10px);
}
.conv-header-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 0.9rem; color: white;
    position: relative; overflow: hidden; border: 2px solid rgba(59,130,246,0.4);
}
.conv-header-avatar img { width: 100%; height: 100%; object-fit: cover; }

.conv-header-info h3 { font-size: 0.95rem; font-weight: 700; color: #fff; margin: 0; }
.conv-header-status { font-size: 0.68rem; color: #22c55e; margin: 0; }
.conv-header-status.offline { color: #6b7280; }

.conv-header-actions { margin-left: auto; display: flex; gap: 8px; }
.admin-call-btn {
    width: 36px; height: 36px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #aaa; font-size: 0.9rem; transition: all 0.25s;
}
.admin-call-btn:hover { border-color: #22c55e; background: rgba(34,197,94,0.15); color: #22c55e; transform: scale(1.1); }

/* ===== MESSAGES AREA ===== */
.conv-messages {
    flex: 1; overflow-y: auto; padding: 16px; display: flex; flex-direction: column; gap: 6px;
}
.conv-messages::-webkit-scrollbar { width: 4px; }
.conv-messages::-webkit-scrollbar-thumb { background: rgba(239,68,68,0.3); border-radius: 2px; }

/* Bubbles */
.a-msg-row { display: flex; align-items: flex-end; gap: 8px; animation: fadeUp 0.2s ease; }
@keyframes fadeUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
.a-msg-row.mine { flex-direction: row-reverse; }
.a-bubble-avatar { width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg,#ef4444,#dc2626); display:flex; align-items:center; justify-content:center; font-size:0.6rem; font-weight:700; flex-shrink:0; overflow:hidden; }
.a-bubble-avatar img { width:100%; height:100%; object-fit:cover; }
.a-bubble { max-width: 60%; padding: 9px 13px; border-radius: 18px; font-size: 0.86rem; line-height: 1.5; word-break: break-word; }
.a-bubble.mine { background: linear-gradient(135deg,#ef4444,#dc2626); color: white; border-bottom-right-radius: 4px; box-shadow: 0 4px 12px rgba(239,68,68,0.3); }
.a-bubble.theirs { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.08); color: #e5e5e5; border-bottom-left-radius: 4px; }
.a-bubble-image { max-width: 200px; border-radius: 14px; overflow: hidden; cursor: pointer; }
.a-bubble-image img { width: 100%; display: block; border-radius: 14px; transition: transform 0.2s; }
.a-bubble-image img:hover { transform: scale(1.02); }
.a-bubble-file { display:flex; align-items:center; gap:8px; padding:6px 10px; background:rgba(255,255,255,0.1); border-radius:10px; font-size:0.78rem; }
.a-bubble-file i { color:#ef4444; font-size:1.2rem; }
.a-meta { font-size: 0.6rem; color: rgba(255,255,255,0.35); margin-top: 3px; }
.a-msg-row.mine .a-meta { text-align: right; }

.a-date-divider { text-align:center; font-size:0.65rem; color:#444; padding:8px 0; }

/* Empty state */
.empty-chat {
    flex: 1; display: flex; align-items: center; justify-content: center; flex-direction: column;
    gap: 16px; color: #333;
}
.empty-chat i { font-size: 4rem; color: rgba(239,68,68,0.1); }
.empty-chat h3 { font-size: 1.1rem; font-weight: 700; color: #444; }
.empty-chat p { font-size: 0.8rem; color: #333; }

/* ===== INPUT ===== */
.conv-input-area {
    padding: 12px 16px; background: rgba(15,15,15,0.9);
    border-top: 1px solid rgba(255,255,255,0.06);
    display: flex; align-items: flex-end; gap: 10px; flex-shrink: 0;
}
.admin-emoji-btn, .admin-attach-btn {
    width: 38px; height: 38px; border-radius: 50%; border: none;
    background: rgba(255,255,255,0.07); color: #aaa; display:flex; align-items:center; justify-content:center;
    cursor:pointer; font-size:1.1rem; transition:all 0.25s; flex-shrink:0;
}
.admin-emoji-btn:hover, .admin-attach-btn:hover { background: rgba(239,68,68,0.15); color:#ef4444; transform:scale(1.1); }
.admin-input-wrap {
    flex:1; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1);
    border-radius:22px; display:flex; align-items:flex-end; padding:7px 13px; transition:border-color 0.3s;
}
.admin-input-wrap:focus-within { border-color: rgba(239,68,68,0.4); }
#admin-msg-input { flex:1; background:transparent; border:none; outline:none; color:white; font-size:0.88rem; resize:none; max-height:100px; font-family:inherit; }
#admin-msg-input::placeholder { color:#444; }
.admin-send-btn {
    width: 40px; height: 40px; border-radius: 50%; border: none;
    background: linear-gradient(135deg,#ef4444,#dc2626); color:white; font-size:0.9rem;
    display:flex; align-items:center; justify-content:center; cursor:pointer;
    transition:all 0.25s; flex-shrink:0; box-shadow:0 4px 12px rgba(239,68,68,0.4);
}
.admin-send-btn:hover { transform:scale(1.1); }

/* Emoji Picker */
.admin-emoji-picker {
    position: absolute; bottom: 72px; left: 340px;
    background: #1a1a1a; border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px; padding: 12px; width: 300px;
    display: none; z-index: 50; box-shadow: 0 10px 40px rgba(0,0,0,0.7);
}
.admin-emoji-picker.show { display: block; }
.a-emoji-grid { display:flex; flex-wrap:wrap; gap:3px; }
.a-emoji-item { width:32px;height:32px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;cursor:pointer;border-radius:8px; }
.a-emoji-item:hover { background:rgba(239,68,68,0.2); }

/* File Preview */
.admin-file-preview { display:none; align-items:center; gap:10px; padding:8px 16px; background:rgba(239,68,68,0.08); border-top:1px solid rgba(239,68,68,0.2); font-size:0.78rem; }
.admin-file-preview.show { display:flex; }
.admin-file-preview img { height:44px; border-radius:6px; }

/* Call Modal */
.admin-call-modal { position:fixed;inset:0;background:rgba(0,0,0,0.88);backdrop-filter:blur(20px);z-index:9999;display:none;align-items:center;justify-content:center; }
.admin-call-modal.show { display:flex; }
.admin-call-card { background:linear-gradient(135deg,#1a1a1a,#111);border:1px solid rgba(239,68,68,0.2);border-radius:22px;padding:36px;text-align:center;min-width:280px;box-shadow:0 30px 60px rgba(0,0,0,0.8); }
.admin-call-avatar { width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#1d4ed8);display:flex;align-items:center;justify-content:center;font-size:2.2rem;font-weight:800;margin:0 auto 14px;border:3px solid rgba(59,130,246,0.4);animation:callPulse 1.5s infinite; }
@keyframes callPulse { 0%,100%{box-shadow:0 0 0 0 rgba(59,130,246,0.5)} 50%{box-shadow:0 0 0 16px rgba(59,130,246,0)} }
.admin-call-status { color:#777;font-size:0.82rem;animation:blink 1.5s infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.4} }
.admin-call-end { width:54px;height:54px;border-radius:50%;border:none;background:#ef4444;color:white;font-size:1.3rem;cursor:pointer;transition:all 0.3s;display:flex;align-items:center;justify-content:center;margin:22px auto 0;box-shadow:0 4px 16px rgba(239,68,68,0.5); }
.admin-call-end:hover { transform:scale(1.1); }

/* Lightbox */
.a-lightbox { position:fixed;inset:0;background:rgba(0,0,0,0.93);z-index:9999;display:none;align-items:center;justify-content:center;cursor:zoom-out; }
.a-lightbox.show { display:flex; }
.a-lightbox img { max-width:90vw;max-height:90vh;border-radius:12px; }

/* No user selected */
.no-user-placeholder { flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;color:#333; }
.no-user-placeholder i { font-size:5rem;color:rgba(239,68,68,0.08); }
.no-user-placeholder h3 { font-size:1.1rem;font-weight:700;color:#444; }
.no-user-placeholder p { font-size:0.78rem;color:#333; }

@media (max-width:768px) {
    .user-list-panel { width:260px; }
    .admin-emoji-picker { left:10px;width:280px; }
}
@media (max-width:600px) {
    .admin-chat-page { flex-direction:column; }
    .user-list-panel { width:100%;height:200px; }
    .admin-emoji-picker { left:10px;bottom:65px; }
}
</style>
@endpush

@section('content')
<div class="p-4 md:p-6" style="height:calc(100vh - 80px);overflow:hidden;">
    <div class="admin-chat-page" style="height:100%;position:relative;">

        {{-- ===== USER LIST PANEL ===== --}}
        <div class="user-list-panel">
            <div class="panel-header">
                <h2><i class="fa-brands fa-whatsapp" style="-webkit-text-fill-color:#22c55e;margin-right:6px;"></i>Chat Inbox</h2>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="userSearch" placeholder="Search conversations..." oninput="filterUsers(this.value)">
                </div>
                {{-- Total unread badge --}}
                <div style="margin-top:8px;font-size:0.72rem;color:#666;">
                    Total unread: <span id="totalUnreadBadge" style="color:#ef4444;font-weight:700;">—</span>
                </div>
            </div>

            <div class="user-list" id="userList">
                @forelse($users as $u)
                    <div class="user-item" data-userid="{{ $u['id'] }}" data-name="{{ strtolower($u['name']) }}" onclick="openConversation({{ $u['id'] }}, '{{ $u['name'] }}', '{{ $u['avatar'] }}', {{ $u['is_online'] ? 'true' : 'false' }})">
                        <div class="user-item-avatar">
                            @if($u['avatar'])
                                <img src="{{ $u['avatar'] }}" alt="{{ $u['name'] }}">
                            @else
                                {{ strtoupper(substr($u['name'],0,2)) }}
                            @endif
                            <span class="status-dot {{ $u['is_online'] ? '' : 'offline' }}"></span>
                        </div>
                        <div class="user-item-info">
                            <div class="user-item-name">{{ $u['name'] }}</div>
                            <div class="user-item-preview">{{ $u['last_message'] ?? 'No messages yet' }}</div>
                        </div>
                        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px;">
                            <div class="user-item-time">{{ $u['last_time'] ?? '' }}</div>
                            @if($u['unread'] > 0)
                                <div class="unread-badge">{{ $u['unread'] }}</div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-chat" style="padding:40px 20px;">
                        <i class="fa-solid fa-comment-slash"></i>
                        <h3>No conversations yet</h3>
                        <p>Users will appear here when they message you</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ===== CONVERSATION PANEL ===== --}}
        <div class="conversation-panel" id="convPanel">
            {{-- No user selected state --}}
            <div class="no-user-placeholder" id="noUserPlaceholder">
                <i class="fa-brands fa-whatsapp"></i>
                <h3>Select a Conversation</h3>
                <p>Choose a user from the left to start chatting</p>
            </div>

            {{-- Active conversation --}}
            <div id="activeConversation" style="display:none;flex-direction:column;height:100%;">
                {{-- Header --}}
                <div class="conv-header">
                    <div class="conv-header-avatar" id="convHeaderAvatar">AD</div>
                    <div class="conv-header-info">
                        <h3 id="convHeaderName">User</h3>
                        <p class="conv-header-status" id="convHeaderStatus">Online</p>
                    </div>
                    <div class="conv-header-actions">
                        <button class="admin-call-btn" onclick="adminCall('audio')" title="Voice Call">
                            <i class="fa-solid fa-phone"></i>
                        </button>
                        <button class="admin-call-btn" onclick="adminCall('video')" title="Video Call">
                            <i class="fa-solid fa-video"></i>
                        </button>
                    </div>
                </div>

                {{-- File Preview --}}
                <div class="admin-file-preview" id="adminFilePreview">
                    <span id="adminFilePreviewContent"></span>
                    <span style="cursor:pointer;color:#ef4444;margin-left:auto;" onclick="adminRemoveFile()">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>

                {{-- Messages --}}
                <div class="conv-messages" id="convMessages"></div>

                {{-- Input --}}
                <div class="conv-input-area">
                    <button class="admin-emoji-btn" id="adminEmojiBtn" onclick="toggleAdminEmoji()">😊</button>
                    <div class="admin-input-wrap">
                        <textarea id="admin-msg-input" placeholder="Type a reply..." rows="1"
                            onkeydown="adminHandleKey(event)" oninput="adminAutoResize(this)"></textarea>
                    </div>
                    <button class="admin-attach-btn" onclick="document.getElementById('adminFileInput').click()">
                        <i class="fa-solid fa-paperclip"></i>
                    </button>
                    <input type="file" id="adminFileInput" accept="image/*,.pdf,.doc,.docx" style="display:none" onchange="adminHandleFile(this)">
                    <button class="admin-send-btn" onclick="adminSend()" id="adminSendBtn">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>

                {{-- Emoji Picker --}}
                <div class="admin-emoji-picker" id="adminEmojiPicker">
                    <div class="a-emoji-grid" id="adminEmojiGrid"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Call Modal --}}
<div class="admin-call-modal" id="adminCallModal">
    <div class="admin-call-card">
        <div class="admin-call-avatar" id="adminCallAvatar">U</div>
        <div style="display:inline-block;padding:3px 12px;background:rgba(239,68,68,0.12);color:#ef4444;border-radius:999px;font-size:0.68rem;font-weight:600;border:1px solid rgba(239,68,68,0.3);margin-bottom:10px;" id="adminCallBadge">Voice Call</div>
        <h3 style="font-size:1.2rem;font-weight:800;margin:0 0 5px;" id="adminCallName">User</h3>
        <p class="admin-call-status" id="adminCallStatus">Calling...</p>
        <button class="admin-call-end" onclick="adminEndCall()"><i class="fa-solid fa-phone-slash"></i></button>
    </div>
</div>

{{-- Lightbox --}}
<div class="a-lightbox" id="aLightbox" onclick="closeALightbox()">
    <img id="aLightboxImg" src="" alt="">
</div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
const ADMIN_NAME = "{{ Auth::user()->name }}";

let activeUserId   = null;
let activeUserName = '';
let lastAdminMsgCount = 0;
let adminSelectedFile = null;
let pollInterval      = null;

// ===== EMOJI =====
const allEmojis = ['😀','😁','😂','🤣','😊','😎','😍','🥰','😘','🤩','😏','😢','😭','😤','🤔','❤️','🧡','💛','💚','💙','💜','👋','👍','👎','✌️','🤞','🙌','🎉','🔥','💯','✅'];

function buildAdminEmoji() {
    const g = document.getElementById('adminEmojiGrid');
    allEmojis.forEach(e => {
        const d = document.createElement('div');
        d.className = 'a-emoji-item';
        d.textContent = e;
        d.onclick = () => adminInsertEmoji(e);
        g.appendChild(d);
    });
}

function toggleAdminEmoji() {
    document.getElementById('adminEmojiPicker').classList.toggle('show');
}
function adminInsertEmoji(e) {
    const inp = document.getElementById('admin-msg-input');
    const s = inp.selectionStart, en = inp.selectionEnd;
    inp.value = inp.value.slice(0,s) + e + inp.value.slice(en);
    inp.setSelectionRange(s+e.length, s+e.length);
    inp.focus();
}
document.addEventListener('click', ev => {
    if (!ev.target.closest('#adminEmojiPicker') && !ev.target.closest('#adminEmojiBtn'))
        document.getElementById('adminEmojiPicker').classList.remove('show');
});

// ===== USER SEARCH =====
function filterUsers(val) {
    document.querySelectorAll('.user-item').forEach(item => {
        const name = item.dataset.name || '';
        item.style.display = name.includes(val.toLowerCase()) ? '' : 'none';
    });
}

// ===== OPEN CONVERSATION =====
function openConversation(userId, userName, avatar, isOnline) {
    activeUserId      = userId;
    activeUserName    = userName;
    lastAdminMsgCount = 0;

    // Update sidebar active
    document.querySelectorAll('.user-item').forEach(i => i.classList.remove('active'));
    document.querySelector(`.user-item[data-userid="${userId}"]`).classList.add('active');

    // Show conversation panel
    document.getElementById('noUserPlaceholder').style.display = 'none';
    const ac = document.getElementById('activeConversation');
    ac.style.display = 'flex';

    // Update header
    const avatarEl = document.getElementById('convHeaderAvatar');
    avatarEl.innerHTML = avatar
        ? `<img src="${avatar}" alt="">`
        : userName.slice(0,2).toUpperCase();

    document.getElementById('convHeaderName').textContent = userName;
    const statusEl = document.getElementById('convHeaderStatus');
    statusEl.textContent = isOnline ? 'Online' : 'Offline';
    statusEl.className = `conv-header-status ${isOnline ? '' : 'offline'}`;

    // Update call modal
    const callAvEl = document.getElementById('adminCallAvatar');
    callAvEl.innerHTML = avatar ? `<img src="${avatar}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">` : userName.slice(0,2).toUpperCase();
    document.getElementById('adminCallName').textContent = userName;

    // Clear messages
    document.getElementById('convMessages').innerHTML = '';

    // Stop old poll
    if (pollInterval) clearInterval(pollInterval);

    // Load + poll
    fetchConvMessages();
    pollInterval = setInterval(fetchConvMessages, 2000);

    // Remove unread badge from sidebar
    const badge = document.querySelector(`.user-item[data-userid="${userId}"] .unread-badge`);
    if (badge) badge.remove();
}

// ===== FETCH MESSAGES =====
function fetchConvMessages() {
    if (!activeUserId) return;
    fetch(`/admin/chat/${activeUserId}/messages`)
        .then(r => r.json())
        .then(data => {
            const msgs = data.messages;
            const area = document.getElementById('convMessages');
            if (msgs.length === lastAdminMsgCount) return;

            const newMsgs = msgs.slice(lastAdminMsgCount);
            newMsgs.forEach(msg => area.appendChild(renderAdminBubble(msg)));
            lastAdminMsgCount = msgs.length;
            area.scrollTop = area.scrollHeight;

            // Update status
            if (data.user) {
                const statusEl = document.getElementById('convHeaderStatus');
                statusEl.textContent = data.user.is_online ? 'Online' : (data.user.last_seen ? `Last seen ${data.user.last_seen}` : 'Offline');
                statusEl.className = `conv-header-status ${data.user.is_online ? '' : 'offline'}`;
            }
        });
}

function renderAdminBubble(msg) {
    const row = document.createElement('div');
    row.className = `a-msg-row ${msg.is_mine ? 'mine' : ''}`;

    const av = document.createElement('div');
    av.className = 'a-bubble-avatar';
    if (msg.avatar) av.innerHTML = `<img src="${msg.avatar}" alt="">`;
    else av.textContent = msg.is_mine ? ADMIN_NAME.slice(0,2).toUpperCase() : activeUserName.slice(0,2).toUpperCase();

    const contentWrap = document.createElement('div');
    const bubble = document.createElement('div');

    if (msg.type === 'image' && msg.file_url) {
        bubble.className = 'a-bubble-image';
        bubble.innerHTML = `<img src="${msg.file_url}" onclick="openALightbox('${msg.file_url}')">`;
    } else if (msg.type === 'file' && msg.file_url) {
        bubble.className = `a-bubble ${msg.is_mine ? 'mine' : 'theirs'}`;
        bubble.innerHTML = `<div class="a-bubble-file"><i class="fa-solid fa-file"></i><span>${msg.file_name || 'File'}</span><a href="${msg.file_url}" download style="color:#ef4444;"><i class="fa-solid fa-download"></i></a></div>`;
    } else {
        bubble.className = `a-bubble ${msg.is_mine ? 'mine' : 'theirs'}`;
        bubble.textContent = msg.body || '';
    }

    const meta = document.createElement('div');
    meta.className = 'a-meta';
    meta.textContent = msg.time + (msg.is_mine && msg.read_at ? ' ✓✓' : msg.is_mine ? ' ✓' : '');

    contentWrap.appendChild(bubble);
    contentWrap.appendChild(meta);
    row.appendChild(av);
    row.appendChild(contentWrap);
    return row;
}

// ===== SEND =====
function adminSend() {
    const inp  = document.getElementById('admin-msg-input');
    const body = inp.value.trim();
    const btn  = document.getElementById('adminSendBtn');
    if (!body && !adminSelectedFile) return;
    if (!activeUserId) return;

    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
    btn.disabled  = true;

    const fd = new FormData();
    fd.append('_token', CSRF);
    if (body) fd.append('body', body);
    if (adminSelectedFile) fd.append('file', adminSelectedFile);

    fetch(`/admin/chat/${activeUserId}/send`, { method: 'POST', body: fd })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                const area = document.getElementById('convMessages');
                area.appendChild(renderAdminBubble(d.message));
                area.scrollTop = area.scrollHeight;
                lastAdminMsgCount++;
                inp.value = '';
                adminAutoResize(inp);
                adminRemoveFile();
            }
        })
        .finally(() => {
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i>';
            btn.disabled  = false;
        });
}

function adminHandleKey(e) {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); adminSend(); }
}
function adminAutoResize(el) {
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 100) + 'px';
}

// ===== FILE =====
function adminHandleFile(inp) {
    const file = inp.files[0];
    if (!file) return;
    adminSelectedFile = file;
    const box  = document.getElementById('adminFilePreview');
    const cont = document.getElementById('adminFilePreviewContent');
    cont.innerHTML = file.type.startsWith('image/')
        ? `<img src="${URL.createObjectURL(file)}" style="height:44px;border-radius:6px;"> <span style="color:#ccc;font-size:0.78rem;">${file.name}</span>`
        : `<i class="fa-solid fa-file" style="color:#ef4444;"></i> <span style="color:#ccc;font-size:0.78rem;">${file.name}</span>`;
    box.classList.add('show');
}
function adminRemoveFile() {
    adminSelectedFile = null;
    document.getElementById('adminFileInput').value = '';
    document.getElementById('adminFilePreview').classList.remove('show');
}

// ===== PING (Admin Online) =====
function adminPing() {
    fetch('/admin/chat/ping', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    });
}
window.addEventListener('beforeunload', () => {
    navigator.sendBeacon('/admin/chat/offline', new URLSearchParams({ _token: CSRF }));
});

// ===== UNREAD TOTAL =====
function fetchTotalUnread() {
    fetch('/admin/chat/unread-count')
        .then(r => r.json())
        .then(d => {
            document.getElementById('totalUnreadBadge').textContent = d.count || 0;
        });
}

// ===== CALL =====
let adminCallTimer = null;
function adminCall(type) {
    document.getElementById('adminCallBadge').textContent = type === 'video' ? '📹 Video Call' : '📞 Voice Call';
    document.getElementById('adminCallModal').classList.add('show');
    let secs = 0;
    const st = document.getElementById('adminCallStatus');
    adminCallTimer = setInterval(() => {
        secs++;
        if (secs < 5) st.textContent = 'Calling...';
        else if (secs < 10) st.textContent = 'Ringing...';
        else {
            st.textContent = 'No answer';
            clearInterval(adminCallTimer);
            setTimeout(adminEndCall, 2000);
        }
    }, 1000);
}
function adminEndCall() {
    clearInterval(adminCallTimer);
    document.getElementById('adminCallModal').classList.remove('show');
}

// ===== LIGHTBOX =====
function openALightbox(url) {
    document.getElementById('aLightboxImg').src = url;
    document.getElementById('aLightbox').classList.add('show');
}
function closeALightbox() { document.getElementById('aLightbox').classList.remove('show'); }

// ===== INIT =====
document.addEventListener('DOMContentLoaded', () => {
    buildAdminEmoji();
    adminPing();
    fetchTotalUnread();
    setInterval(adminPing, 30000);
    setInterval(fetchTotalUnread, 10000);
});
</script>
@endpush
