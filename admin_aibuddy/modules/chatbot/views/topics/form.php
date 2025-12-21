<?php
require_once __DIR__ . '/../../controllers/TopicController.php';
$controller = new TopicController();
$controller->save();

$topic = null;
if (isset($_GET['id'])) {
    $topic = $controller->edit($_GET['id']);
}

$path = '../';
include __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo $topic ? 'Edit Topic' : 'Create New Topic'; ?></h1>
    <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-body">
        <form method="POST">
            <?php if ($topic): ?>
                <input type="hidden" name="TopicID" value="<?php echo $topic['TopicID']; ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label fw-bold">Topic Name</label>
                <input type="text" class="form-control" name="TopicName" value="<?php echo $topic['TopicName'] ?? ''; ?>" required placeholder="e.g. Exam Stress">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea class="form-control" name="Description" rows="3" required placeholder="What is this topic about?"><?php echo $topic['Description'] ?? ''; ?></textarea>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Topic</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>