<div class="chat-layout-container">

    <aside class="sidebar-left" id="sidebar-left">
        <div style="padding: 15px;">
            <button class="new-chat-btn" onclick="startNewChat()" style="width: 100%; padding: 10px; background: #124559; color: white; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <i class="fa-solid fa-plus"></i> New Chat
            </button>
        </div>

        <div class="persona-list" id="persona-list-container" style="padding: 0 15px; margin-bottom: 20px;">
            <h4 style="margin-bottom: 10px; color: #666; font-size: 0.85rem; text-transform: uppercase;">Persona</h4>
            <p style="text-align:center; color:#888; font-size:0.9rem;">Loading...</p> 
        </div>

        <div class="chat-history-list" style="flex: 1; overflow-y: auto; padding: 0 15px;">
            <h4 style="margin-bottom: 10px; color: #666; font-size: 0.85rem; text-transform: uppercase;">History</h4>
            <ul id="history-list" style="list-style: none; padding: 0;">
                <li><p style="color:#888; font-size:0.9rem;">Loading history...</p></li>
            </ul>
        </div>
    </aside>


    <main class="chat-main">
        <div class="chat-window" id="chat-window" style="flex:1; padding:20px; overflow-y:auto; display: flex; flex-direction: column; gap: 15px;">
            <div class="message msg-ai" style="align-self: flex-start; background: #f0f2f5; padding: 12px 16px; border-radius: 12px; max-width: 80%; position: relative; margin-left: 35px;">
                <span class="ai-avatar" style="position: absolute; left: -35px; bottom: 0; font-size: 1.5rem;">🤖</span>
                <p style="margin: 0;">Hi there! I'm AI Buddy. How can I help you today?</p>
            </div>
        </div>

        <div id="image-preview-container" style="display: none; padding: 10px 20px; background: #fff; border-top: 1px solid #eee;">
            <div style="position: relative; display: inline-block;">
                <img id="image-preview" src="" style="max-height: 80px; border-radius: 8px; border: 1px solid #ddd;">
                <button onclick="clearImage()" style="position: absolute; top: -8px; right: -8px; background: #e74c3c; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; font-weight: bold;">&times;</button>
            </div>
        </div>

        <div class="chat-input-area" style="padding: 15px 20px; background: #fff; display:flex; gap:10px; align-items:flex-end; border-top: 1px solid #eee;">
            <input type="file" id="image-upload" accept="image/*" style="display: none;">

            <button class="input-btn" title="Upload Image" onclick="document.getElementById('image-upload').click()" style="width:40px; height:40px; border-radius:50%; border:none; background:#f0f2f5; color:#555; cursor:pointer; transition:0.2s;">
                <i class="fa-solid fa-paperclip"></i>
            </button>
            
            <textarea id="message-input" placeholder="Type your message..." rows="1" style="flex:1; padding:10px 15px; border-radius:20px; border:1px solid #ddd; resize:none; background:#f0f2f5; outline:none; font-family:inherit; min-height:42px; max-height: 120px;"></textarea>
            
            <button class="input-btn" id="call-btn" title="Voice Input" style="width:40px; height:40px; border-radius:50%; border:none; background:#f0f2f5; color:#555; cursor:pointer;">
                <i class="fa-solid fa-microphone"></i>
            </button>
            
            <button class="input-btn" id="send-btn" title="Send" style="width:40px; height:40px; border-radius:50%; border:none; background:#33c6e7; color:white; cursor:pointer; box-shadow: 0 2px 5px rgba(51, 198, 231, 0.4);">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
        
        <div id="call-status" style="text-align: center; font-size: 11px; padding-bottom: 5px; color: #888; background: #fff;"></div>
    </main>


    <aside class="sidebar-right" id="sidebar-right">
        <div style="padding: 20px;">
            <div class="widget-box" style="margin-bottom: 25px; background:#fff; padding:15px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.03);">
                <h4 style="margin-bottom:12px; color:#124559; font-size:1rem;"><i class="fa-regular fa-lightbulb"></i> Topics for you</h4>
                <div class="topic-pills" id="topic-list-container" style="display:flex; flex-wrap:wrap; gap:8px;">
                    <span style="font-size:0.85rem; color:#888;">Loading topics...</span>
                </div>
            </div>

            <div class="widget-box" style="margin-bottom: 25px; background:#fff; padding:15px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.03); text-align:center;">
                <h4 style="margin-bottom:10px; color:#124559; font-size:1rem;"><i class="fa-solid fa-wind"></i> Feeling stressed?</h4>
                <p style="font-size:0.85rem; color:#666; margin-bottom:15px;">Take a moment to breathe.</p>
                <div class="mini-breathing-circle" style="width:60px; height:60px; background:#aec3b0; border-radius:50%; margin:0 auto; animation: breathe 4s infinite ease-in-out; display:flex; align-items:center; justify-content:center; color:white; font-size:10px;">
                    In/Out
                </div>
                <style>
                    @keyframes breathe {
                        0%, 100% { transform: scale(1); opacity: 0.8; }
                        50% { transform: scale(1.3); opacity: 1; }
                    }
                </style>
            </div>
            
            <div class="widget-box" style="background: linear-gradient(135deg, #124559 0%, #33c6e7 100%); padding:20px; border-radius:12px; color:white; text-align:center;">
                <h4 style="margin-bottom:10px; font-size:1rem;"><i class="fa-solid fa-headphones"></i> Relax Mode</h4>
                <p style="font-size:0.85rem; opacity:0.9; margin-bottom:15px;">Unlock exclusive audio.</p>
                <a href="AIBuddy_Trial.php" style="display:inline-block; background:white; color:#124559; padding:8px 16px; border-radius:20px; text-decoration:none; font-size:0.85rem; font-weight:bold;">
                    Upgrade Now
                </a>
            </div>
        </div>
    </aside>

</div>