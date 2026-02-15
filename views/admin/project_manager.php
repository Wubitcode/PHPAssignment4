<?php
// project_manager.php
require __DIR__ . '/../../db/database.php';

// ----------------------------
// DELETE PROJECT IF CODE IS SET
// ----------------------------
if (isset($_GET['delete_code'])) {
    $stmt = $db->prepare("DELETE FROM products WHERE productCode = ?");
    $stmt->execute([$_GET['delete_code']]);
    // Redirect to refresh page and avoid resubmission
    header("Location: project_manager.php");
    exit;
}

// ----------------------------
// FETCH ALL PROJECTS
// ----------------------------
$projects = $db->query("SELECT productCode, name, version, releaseDate FROM products")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../header.php';
?>

<div class="container mt-5">
    <h2 class="mb-3">Project List</h2>

    <!-- Projects Table -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Project Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($projects): ?>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?= htmlspecialchars($project['productCode']) ?></td>
                        <td><?= htmlspecialchars($project['name']) ?></td>
                        <td><?= htmlspecialchars($project['version']) ?></td>
                        <td><?= htmlspecialchars($project['releaseDate']) ?></td>
                        <td>
                            <!-- DELETE BUTTON -->
                            <a href="project_manager.php?delete_code=<?= $project['productCode'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this project?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No projects found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- ADD NEW PROJECT BUTTON -->
    <div class="mt-3">
        <a href="add_project.php" class="btn btn-primary">Add New Project</a>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
