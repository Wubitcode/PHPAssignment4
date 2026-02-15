<?php
require __DIR__ . '/../../db/database.php';

// Fetch customers and products for dropdown
$customers = $db->query("SELECT customerID, firstName, lastName FROM customers")->fetchAll(PDO::FETCH_ASSOC);
$products = $db->query("SELECT productCode, name FROM products")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../header.php';
?>

<h2 class="mb-3">Create Incident</h2>
<form action="add_incident.php" method="post" class="mb-4">
    <div class="mb-3">
        <label class="form-label">Customer *</label>
        <select name="customerID" class="form-select" required>
            <option value="">Select Customer</option>
            <?php foreach ($customers as $c): ?>
                <option value="<?= $c['customerID'] ?>">
                    <?= htmlspecialchars($c['firstName'] . ' ' . $c['lastName']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Product *</label>
        <select name="productCode" class="form-select" required>
            <option value="">Select Product</option>
            <?php foreach ($products as $p): ?>
                <option value="<?= $p['productCode'] ?>">
                    <?= htmlspecialchars($p['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Title *</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Incident</button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>
