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
      body {
          margin: 0;
          padding: 0;
          display: flex;
          flex-direction: column;
          height: 100vh;
          overflow: hidden;
          background-color: #ffffff; /* Đặt nền trắng để tránh vệt xanh */
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      /* --- HEADER STYLES (Đồng bộ) --- */
      header {
          background-color: #ffffff;
          padding: 0;
          height: 70px; /* Cố định chiều cao header */
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
          flex-shrink: 0;
          z-index: 100;
          display: flex;
          align-items: center;
          border-bottom: 1px solid #eaeaea;
      }
      .container {
          width: 95%; /* Mở rộng chiều rộng header cho cân đối với chat full screen */
          max-width: 1400px;
          margin: 0 auto;
      }
      .header-content {
          display: flex;
          justify-content: space-between;
          align-items: center;
          width: 100%;
      }
      .logo {
          font-size: 22px;
          font-weight: bold;
          color: #124559;
          display: flex;
          align-items: center;
          text-decoration: none;
      }
      .logo-icon { margin-right: 8px; font-size: 26px; }
      
      nav { display: flex; align-items: center; }
      nav a {
          margin: 0 12px;
          text-decoration: none;
          color: #124559;
          font-weight: 500;
          font-size: 0.95rem;
          transition: color 0.3s;
      }
      nav a:hover { color: #33c6e7; }
      nav a.active { color: #33c6e7; font-weight: bold; }

      .user-greeting-badge {
          background-color: #f0f7f4;
          color: #124559;
          padding: 6px 16px;
          border-radius: 20px;
          font-size: 0.9rem;
          font-weight: 500;
          border: 1px solid #aec3b0;
          white-space: nowrap;
      }

      /* --- CHAT LAYOUT GRID (3 CỘT) --- */
      .chat-layout-container {
          flex: 1;
          display: grid;
          /* Cấu trúc: Sidebar Trái (260px) - Chat Chính (Tự động) - Sidebar Phải (300px) */
          grid-template-columns: 260px 1fr 300px; 
          background-color: #ffffff;
          overflow: hidden; /* Quan trọng để cuộn độc lập */
      }

      /* --- RESPONSIVE --- */
      /* Tablet & Laptop nhỏ: Ẩn cột phải, có thể toggle sau này nếu cần */
      @media (max-width: 1100px) {
          .chat-layout-container {
              grid-template-columns: 250px 1fr; /* Ẩn cột phải */
          }
          #sidebar-right { display: none; }
      }

      /* Mobile: 1 Cột duy nhất */
      @media (max-width: 768px) {
          nav { display: none; }
          .user-greeting-badge { display: none; }
          .header-toggles { display: flex; gap: 15px; }
          
          .chat-layout-container {
              grid-template-columns: 1fr;
          }
          /* Ẩn sidebar trái và phải mặc định */
          .sidebar-left { display: none; position: absolute; z-index: 1000; height: 100%; background: #fff; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
          .sidebar-left.active { display: block; }
          #sidebar-right { display: none; }
      }
      
      .mobile-toggle-btn { background: none; border: none; font-size: 1.2rem; color: #124559; cursor: pointer; }
      .header-toggles { display: none; }
  </style>
</head>
<body>

  <header>
      <div class="container header-content">
          <a href="AIBuddy_Homepage.php" class="logo">
              <span class="logo-icon">🤖</span> AI Buddy
          </a>
          <nav>
              <a href="AIBuddy_Homepage.php">Home</a>
              <a href="AIBuddy_Chatbot.php" class="active">Chatbot</a>
              <a href="AIBuddy_EmotionTracker.php">Emotion Tracker</a>
              <a href="AIBuddy_Trial.php">Trial</a>
              <a href="AIBuddy_Profile.php">Profile</a>
              <a href="AIBuddy_About.php">About</a>
              <a href="AIBuddy_Contact.php">Contact</a>
          </nav>
          
          <div style="display: flex; align-items: center; gap: 15px;">
              <?php if (isset($_SESSION['userid']) && isset($user)): ?>
                  <div class="user-greeting-badge">Hi, <strong><?= htmlspecialchars($user['UserName']) ?></strong></div>
              <?php else: ?>
                  <a href="AIBuddy_SignIn.php" style="text-decoration:none; color:#33c6e7; font-weight:600;">Sign In</a>
              <?php endif; ?>

              <div class="header-toggles">
                  <button id="menu-toggle" class="mobile-toggle-btn"><i class="fa-solid fa-bars"></i></button>
              </div>
          </div>
      </div>
  </header>

  <?php 
     $currentUserID = $_SESSION['userid'];
     echo "<script>const CURRENT_USER_ID = $currentUserID;</script>";
     
     // Include View Chatbot
     include 'modules/chatbot/views/index.php'; 
  ?>

  <script src="assets/js/chatbot.js"></script>
  <script>
      // Toggle Mobile Menu
      const menuToggle = document.getElementById('menu-toggle');
      const sidebarLeft = document.getElementById('sidebar-left');
      if(menuToggle && sidebarLeft) {
          menuToggle.addEventListener('click', () => sidebarLeft.classList.toggle('active'));
      }
  </script>
</body>
</html>