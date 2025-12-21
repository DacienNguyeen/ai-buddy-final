<?php
session_start();
// Kiểm tra đăng nhập (Logic cũ của bạn)
if (!isset($_SESSION['UserID'])) {
    header("Location: AIBuddy_SignIn.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AI Buddy - Chatbot</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/chatbot.css">
  <style> body { background-color: #eff6e0; } </style>
</head>
<body>
  <header>
    <div class="container header-content">
      <div class="logo"><span class="logo-icon">🤖</span> AI Buddy</div>
      <nav>
        <a href="AIBuddy_Homepage.php">Home</a>
        <a href="AIBuddy_Chatbot.php" style="color:#33c6e7; font-weight:bold;">Chatbot</a>
        <a href="AIBuddy_EmotionTracker.php">Emotion Tracker</a>
        <a href="AIBuddy_Trial.php">Plans</a>
        <a href="AIBuddy_Profile.php">Profile</a>
      </nav>
      <div class="header-toggles">
          <button id="menu-toggle" class="mobile-toggle-btn"><i class="fa-solid fa-bars"></i></button>
      </div>
    </div>
  </header>

  <?php 
     // Truyền UserID xuống JS
     $currentUserID = $_SESSION['UserID'];
     echo "<script>const CURRENT_USER_ID = $currentUserID;</script>";
     
     // Include View của module
     include 'modules/chatbot/views/index.php'; 
  ?>

  <script src="assets/js/chatbot.js"></script>
</body>
</html>