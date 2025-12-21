<?php
require_once __DIR__ . '/../../controllers/PersonaController.php';
$controller = new PersonaController();
$personas = $controller->index();

// --- THÊM DÒNG NÀY ---
$path = '../';
// --------------------

include __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Personas</h1>
    <a href="form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Persona</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm p-3">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Icon</th>
                <th>Name</th>
                <th>Description</th>
                <th>Premium</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personas as $p): ?>
            <tr>
                <td>#<?php echo $p['PersonaID']; ?></td>
                <td class="fs-4"><?php echo $p['Icon']; ?></td>
                <td class="fw-bold"><?php echo htmlspecialchars($p['PersonaName']); ?></td>
                <td><?php echo htmlspecialchars($p['Description']); ?></td>
                <td>
                    <?php if ($p['IsPremium']): ?>
                        <span class="badge bg-warning text-dark">Premium</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Free</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="form.php?id=<?php echo $p['PersonaID']; ?>" class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="delete.php?id=<?php echo $p['PersonaID']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>