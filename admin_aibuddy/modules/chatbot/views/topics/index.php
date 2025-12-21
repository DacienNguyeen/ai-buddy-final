<?php
require_once __DIR__ . '/../../controllers/TopicController.php';
$controller = new TopicController();
$topics = $controller->index();

// Config đường dẫn header
$path = '../'; 
include __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Topics</h1>
    <a href="form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create Topic</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm p-3">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Topic Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topics as $t): ?>
            <tr>
                <td>#<?php echo $t['TopicID']; ?></td>
                <td class="fw-bold text-primary"><?php echo htmlspecialchars($t['TopicName']); ?></td>
                <td><?php echo htmlspecialchars($t['Description']); ?></td>
                <td>
                    <a href="form.php?id=<?php echo $t['TopicID']; ?>" class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="delete.php?id=<?php echo $t['TopicID']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>