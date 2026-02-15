<?php
// add_project.php
require __DIR__ . '/../../db/database.php'; 

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = trim($_POST['productCode']);
    $name = trim($_POST['name']);
    $version = trim($_POST['version']);
    $releaseDate = trim($_POST['releaseDate']);

    if (!$productCode || !$name || !$version || !$releaseDate) {
        $error = 'All fields are required.';
    } else {
        // Insert into products table
        $sql = "INSERT INTO products (productCode, name, version, releaseDate)
                VALUES (:productCode, :name, :version, :releaseDate)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':productCode', $productCode);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':version', $version);
        $stmt->bindValue(':releaseDate', $releaseDate);
        $stmt->execute();

        // Redirect back to project_manager.php
        header('Location: project_manager.php');
        exit;
    }
}
?>

<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <h2 class="mb-3">Add New Project</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Project Code *</label>
            <input type="text" name="productCode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Version *</label>
            <input type="text" name="version" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Release Date *</label>
            <input type="date" name="releaseDate" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add Project</button>
        <a href="project_manager.php" class="btn btn-secondary">Back to List</a>
    </form>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
