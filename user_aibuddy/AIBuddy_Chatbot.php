<?php
session_start();
require_once 'config/db.php';

// 1. Kiểm tra đăng nhập
if (!isset($_SESSION['userid'])) {
    header("Location: AIBuddy_SignIn.php");
    exit();
}

// 2. Lấy thông tin User
$UserID = $_SESSION['userid'];
$stmt = $conn->prepare("SELECT UserName FROM users WHERE UserID = ?");
$stmt->bind_param("i", $UserID);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AI Buddy - Chatbot</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/chatbot.css">
  
  <style>
      /* --- GLOBAL RESET --- */
      :root {
          --primary-dark: #124559;
          --primary-light: #33c6e7;
          --bg-light: #f0f2f5;
          --white: #ffffff;
          --header-height: 60px;
      }

      body {
          margin: 0; padding: 0;
          display: flex; flex-direction: column;
          height: 100vh; overflow: hidden;
          background-color: var(--white);
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      /* --- HEADER STYLES --- */
      header {
          background-color: var(--white);
          height: var(--header-height);
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
          flex-shrink: 0;
          z-index: 100;
          display: flex; align-items: center;
          border-bottom: 1px solid #eaeaea;
          padding: 0 20px;
      }
      
      .header-content {
          display: flex; justify-content: space-between; align-items: center;
          width: 100%; max-width: 1600px; margin: 0 auto;
      }

      .logo {
          font-size: 20px; font-weight: bold; color: var(--primary-dark);
          display: flex; align-items: center; text-decoration: none;
      }
      .logo-icon { margin-right: 8px; font-size: 24px; }
      
      /* Navigation Desktop */
      nav { display: flex; align-items: center; }
      nav a {
          margin: 0 12px; text-decoration: none; color: var(--primary-dark);
          font-weight: 500; font-size: 0.95rem; transition: color 0.3s;
      }
      nav a:hover, nav a.active { color: var(--primary-light); }

      .user-greeting-badge {
          background-color: #f0f7f4; color: var(--primary-dark);
          padding: 6px 16px; border-radius: 20px; font-size: 0.9rem;
          font-weight: 500; border: 1px solid #aec3b0; white-space: nowrap;
      }

      /* Mobile Toggles (Hidden on Desktop) */
      .header-toggles { display: none; gap: 15px; }
      .mobile-toggle-btn {
          background: none; border: none; font-size: 1.3rem;
          color: var(--primary-dark); cursor: pointer; padding: 5px;
      }

      /* --- CHAT LAYOUT GRID (3 COLUMNS) --- */
      .chat-layout-container {
          flex: 1; /* Chiếm hết chiều cao còn lại */
          display: grid;
          /* Sidebar Trái (260px) - Chat Chính (Auto) - Sidebar Phải (300px) */
          grid-template-columns: 260px 1fr 300px; 
          background-color: var(--white);
          height: calc(100vh - var(--header-height));
          position: relative;
      }

      /* Sidebar Styles General */
      .sidebar-left, .sidebar-right {
          overflow-y: auto;
          background: var(--white);
          border-right: 1px solid #f0f0f0;
          display: flex; flex-direction: column;
      }
      .sidebar-right { border-left: 1px solid #f0f0f0; border-right: none; background: #f9fbfd; }

      /* Main Chat Area */
      .chat-main {
          display: flex; flex-direction: column;
          background: var(--white);
          position: relative;
          overflow: hidden;
      }

      /* --- RESPONSIVE DESIGN --- */

      /* Tablet (Medium Screens): Ẩn cột phải, hiện Toggle phải */
      @media (max-width: 1024px) {
          .chat-layout-container {
              grid-template-columns: 250px 1fr; /* Ẩn cột phải */
          }
          #sidebar-right {
              position: fixed; top: var(--header-height); bottom: 0; right: 0;
              width: 280px; z-index: 1000;
              transform: translateX(100%); transition: transform 0.3s ease;
              box-shadow: -2px 0 10px rgba(0,0,0,0.1);
          }
          #sidebar-right.active { transform: translateX(0); }
          
          /* Hiện nút toggle phải trên tablet */
          .header-toggles { display: flex; }
          #menu-toggle { display: none; } /* Vẫn hiện sidebar trái nên ẩn toggle trái */
          .desktop-nav-links { display: none; } /* Ẩn menu chữ nếu chật */
      }

      /* Mobile (Small Screens) */
      @media (max-width: 768px) {
          /* Header changes */
          nav { display: none; }
          .user-greeting-badge { display: none; }
          .header-toggles { display: flex; width: auto; }
          #menu-toggle { display: block; } /* Hiện cả 2 nút */

          /* Grid chuyển thành 1 cột */
          .chat-layout-container { grid-template-columns: 1fr; }

          /* Sidebar Trái: Trượt từ trái ra */
          .sidebar-left {
              position: fixed; top: var(--header-height); bottom: 0; left: 0;
              width: 80%; max-width: 300px; z-index: 1001;
              transform: translateX(-100%); transition: transform 0.3s ease;
              box-shadow: 2px 0 10px rgba(0,0,0,0.1);
              border-right: none;
          }
          .sidebar-left.active { transform: translateX(0); }

          /* Sidebar Phải: Trượt từ phải ra */
          #sidebar-right {
              position: fixed; top: var(--header-height); bottom: 0; right: 0;
              width: 80%; max-width: 300px; z-index: 1001;
              transform: translateX(100%); transition: transform 0.3s ease;
              box-shadow: -2px 0 10px rgba(0,0,0,0.1);
          }
          #sidebar-right.active { transform: translateX(0); }
      }

      /* Overlay (Lớp phủ đen mờ khi mở menu trên mobile) */
      .sidebar-overlay {
          display: none; position: fixed;
          top: 0; left: 0; right: 0; bottom: 0;
          background: rgba(0,0,0,0.5); z-index: 999;
      }
      .sidebar-overlay.active { display: block; }

  </style>
</head>
<body>

  <div id="overlay" class="sidebar-overlay"></div>

  <header>
      <div class="header-content">
          <a href="AIBuddy_Homepage.php" class="logo">
              <span class="logo-icon">🤖</span> AI Buddy
          </a>
          
          <nav>
              <div class="desktop-nav-links">
                <a href="AIBuddy_Homepage.php">Home</a>
                <a href="AIBuddy_Chatbot.php" class="active">Chatbot</a>
                <a href="AIBuddy_EmotionTracker.php">Emotion Tracker</a>
                <a href="AIBuddy_Trial.php">Trial</a>
                <a href="AIBuddy_Profile.php">Profile</a>
              </div>
          </nav>
          
          <div style="display: flex; align-items: center; gap: 15px;">
              <?php if (isset($_SESSION['userid']) && isset($user)): ?>
                  <div class="user-greeting-badge">Hi, <strong><?= htmlspecialchars($user['UserName']) ?></strong></div>
              <?php endif; ?>

              <div class="header-toggles">
                  <button id="menu-toggle" class="mobile-toggle-btn" title="History"><i class="fa-solid fa-bars"></i></button>
                  <button id="tools-toggle" class="mobile-toggle-btn" title="Topics"><i class="fa-solid fa-sliders"></i></button>
              </div>
          </div>
      </div>
  </header>

  <?php 
     $currentUserID = $_SESSION['userid'];
     echo "<script>const CURRENT_USER_ID = $currentUserID;</script>";
     
     // Include View Chatbot đã được làm sạch code
     include 'modules/chatbot/views/index.php'; 
  ?>

  <script src="assets/js/chatbot.js"></script>
  
  <script>
      // --- LOGIC RESPONSIVE TOGGLE ---
      const menuToggle = document.getElementById('menu-toggle');
      const toolsToggle = document.getElementById('tools-toggle');
      const sidebarLeft = document.getElementById('sidebar-left');
      const sidebarRight = document.getElementById('sidebar-right');
      const overlay = document.getElementById('overlay');

      function closeAllSidebars() {
          if(sidebarLeft) sidebarLeft.classList.remove('active');
          if(sidebarRight) sidebarRight.classList.remove('active');
          if(overlay) overlay.classList.remove('active');
      }

      // Toggle Sidebar Trái (History)
      if(menuToggle && sidebarLeft) {
          menuToggle.addEventListener('click', () => {
              const isActive = sidebarLeft.classList.contains('active');
              closeAllSidebars(); // Đóng cái kia trước
              if(!isActive) {
                  sidebarLeft.classList.add('active');
                  overlay.classList.add('active');
              }
          });
      }

      // Toggle Sidebar Phải (Topics)
      if(toolsToggle && sidebarRight) {
          toolsToggle.addEventListener('click', () => {
              const isActive = sidebarRight.classList.contains('active');
              closeAllSidebars();
              if(!isActive) {
                  sidebarRight.classList.add('active');
                  overlay.classList.add('active');
              }
          });
      }

      // Bấm ra ngoài (overlay) thì đóng menu
      if(overlay) {
          overlay.addEventListener('click', closeAllSidebars);
      }
  </script>
</body>
</html>