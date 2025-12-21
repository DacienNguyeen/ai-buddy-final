<div class="sidebar">
    
    <div class="brand">
        <i class="fa-solid fa-robot"></i> 
        <span>AI Buddy</span>
    </div>

    <a href="<?php echo BASE_URL; ?>index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
        <i class="fa-solid fa-house"></i>
        <span>Overview</span>
    </a>
    
    <a href="<?php echo BASE_URL; ?>modules/users/index.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'modules/users') !== false ? 'active' : ''; ?>"> 
        <i class="fa-solid fa-users"></i>
        <span>Users</span>
    </a>
    
    <a href="<?php echo BASE_URL; ?>modules/plans/index.php">
        <i class="fa-solid fa-gem"></i>
        <span>Service Plans</span>
    </a>
    
    <a href="<?php echo BASE_URL; ?>modules/orders/index.php">
        <i class="fa-solid fa-file-invoice-dollar"></i>
        <span>Orders</span>
    </a>
    
    <a href="<?php echo BASE_URL; ?>modules/reports/index.php">
        <i class="fa-solid fa-envelope"></i>
        <span>Reports & Refunds</span>
    </a>

  <a href="<?php echo BASE_URL; ?>modules/emote/index.php">
    <i class="fa-solid fa-face-smile"></i>
    <span>EmoteTracker Management</span>
</a>
    <a href="<?php echo BASE_URL; ?>modules/chatbot/index.php">
    <i class="fa-solid fa-robot"></i>
    <span>Chatbots</span>
</a>
    
   
    
    <a href="<?php echo BASE_URL; ?>logout.php" onclick="return confirm('Are you sure you want to log out?');">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Logout</span>
    </a>

</div>