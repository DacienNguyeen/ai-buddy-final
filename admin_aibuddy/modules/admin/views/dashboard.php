<?php
require_once __DIR__ . '/../controllers/DashboardController.php';

// --- THÊM DÒNG NÀY ---
$path = ''; 
// -------------------

// 1. Khởi tạo Controller và lấy số liệu
$controller = new DashboardController();
$stats = $controller->getStats();

// 2. Load Header
include __DIR__ . '/layouts/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Overview</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Users</h6>
                    <h3><?php echo $stats['users']; ?></h3>
                </div>
                <div class="fs-1 text-primary"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Chat Sessions</h6>
                    <h3><?php echo $stats['sessions']; ?></h3>
                </div>
                <div class="fs-1 text-success"><i class="fas fa-comments"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">AI Personas</h6>
                    <h3><?php echo $stats['personas']; ?></h3>
                </div>
                <div class="fs-1 text-warning"><i class="fas fa-robot"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-stat p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Active Topics</h6>
                    <h3><?php echo $stats['topics']; ?></h3>
                </div>
                <div class="fs-1 text-info"><i class="fas fa-lightbulb"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <p>Welcome to the AI Buddy Management System. Use the sidebar to manage content.</p>
                <a href="personas/index.php" class="btn btn-outline-primary me-2">Add New Persona</a>
                <a href="topics/index.php" class="btn btn-outline-secondary">Create Topic</a>
            </div>
        </div>
    </div>
</div>

<?php
// 3. Load Footer
include __DIR__ . '/layouts/footer.php';
?>