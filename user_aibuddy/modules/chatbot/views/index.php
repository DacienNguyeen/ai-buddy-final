  <div class="chat-layout-container">

      <aside class="sidebar-left" id="sidebar-left">
          <button class="new-chat-btn" onclick="startNewChat()">
              <i class="fa-solid fa-plus"></i> Start a new chat
          </button>

          <div class="persona-list" id="persona-list-container">
              <h4>Choose Persona</h4>
              <p style="text-align:center; color:#888; font-size:0.9rem;">Loading...</p> 
          </div>

          <div class="chat-history-list" style="flex: 1; overflow-y: auto;">
              <h4>Chat History</h4>
              <ul id="history-list">
                  <li><p style="color:#888; font-size:0.9rem; padding:10px;">Loading history...</p></li>
              </ul>
          </div>
      </aside>

      <main class="chat-main" style="display:flex; flex-direction:column; background:#fff; border-left:1px solid #f0f0f0; border-right:1px solid #f0f0f0;">
          <div class="chat-window" id="chat-window" style="flex:1; padding:20px; overflow-y:auto;">
              <div class="message msg-ai">
                  <span class="ai-avatar">🤖</span>
                  <p>Hi there! I'm AI Buddy. How can I help you today?</p>
              </div>
          </div>

          <div id="image-preview-container" style="display: none; padding: 10px 20px; background: #fff; border-top: 1px solid #eee;">
              <div style="position: relative; display: inline-block;">
                  <img id="image-preview" src="" style="max-height: 80px; border-radius: 8px; border: 1px solid #ddd;">
                  <button onclick="clearImage()" style="position: absolute; top: -5px; right: -5px; background: #e74c3c; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer;">&times;</button>
              </div>
          </div>

          <div class="chat-input-area" style="padding: 20px; background: #fff; display:flex; gap:12px; align-items:flex-end;">
              <input type="file" id="image-upload" accept="image/*" style="display: none;">

              <button class="input-btn" title="Upload Image" onclick="document.getElementById('image-upload').click()" style="width:40px; height:40px; border-radius:50%; border:none; background:#f0f2f5; color:#555; cursor:pointer; transition:0.2s;">
                  <i class="fa-solid fa-paperclip"></i>
              </button>
              
              <textarea id="message-input" placeholder="Type your message..." rows="1" style="flex:1; padding:12px 15px; border-radius:24px; border:1px solid #ddd; resize:none; background:#f0f2f5; outline:none; font-family:inherit; min-height:45px;"></textarea>
              
              <button class="input-btn" id="call-btn" title="Voice Input" style="width:40px; height:40px; border-radius:50%; border:none; background:#f0f2f5; color:#555; cursor:pointer;">
                  <i class="fa-solid fa-microphone"></i>
              </button>
              
              <button class="input-btn" id="send-btn" title="Send" style="width:40px; height:40px; border-radius:50%; border:none; background:#33c6e7; color:white; cursor:pointer; box-shadow: 0 2px 5px rgba(51, 198, 231, 0.4);">
                  <i class="fa-solid fa-paper-plane"></i>
              </button>
          </div>
          
          <div id="call-status" style="text-align: center; font-size: 11px; padding-bottom: 5px; color: #888;"></div>
      </main>

      <aside class="sidebar-right" id="sidebar-right" style="padding: 20px; background-color: #f9fbfd; overflow-y: auto;">
          
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
              <p style="font-size:0.85rem; opacity:0.9; margin-bottom:15px;">Unlock exclusive relaxation audio tracks with Premium.</p>
              <a href="AIBuddy_Trial.php" style="display:inline-block; background:white; color:#124559; padding:8px 16px; border-radius:20px; text-decoration:none; font-size:0.85rem; font-weight:bold;">
                  Upgrade Now
              </a>
          </div>
      </aside>

  </div>