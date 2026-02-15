<?php
// Include database connection (PDO)
require __DIR__ . '/../../db/database.php';

// Include common header (Bootstrap, nav, etc.)
require __DIR__ . '/../header.php';

// Get customer ID from URL (GET request) and validate it as an integer
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// If ID is missing or invalid, redirect back to manage customers page
if (!$id) {
    header("Location: manage_customers.php");
    exit;
}

// Prepare SQL to fetch the selected customer
$stmt = $db->prepare("SELECT * FROM customers WHERE customerID = :id");

// Execute query with bound parameter
$stmt->execute(['id' => $id]);

// Fetch customer data as associative array
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

// If customer not found, redirect back
if (!$customer) {
    header("Location: manage_customers.php");
    exit;
}

// Get error message from URL if exists (used for validation feedback)
$error = $_GET['error'] ?? '';
?>

<div class="container mt-4">
    <h2 class="mb-3">Edit Customer</h2>

    <!-- Display error message if present -->
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Edit customer form -->
    <form method="post" action="update_customer.php" class="card p-3 shadow-sm">

        <!-- Hidden field to keep customer ID -->
        <input type="hidden" name="customerID" value="<?= $customer['customerID'] ?>">

        <!-- Loop through customer fields dynamically -->
        <?php foreach ($customer as $key => $value): ?>

            <!-- Skip primary key field (already handled above) -->
            <?php if ($key === 'customerID') continue; ?>

            <div class="mb-3">
                <label class="form-label"><?= ucfirst($key) ?></label>

                <!-- Pre-fill input values safely -->
                <input
                    name="<?= $key ?>"
                    class="form-control"
                    required
                    value="<?= htmlspecialchars($value) ?>">
            </div>

        <?php endforeach; ?>

        <!-- Action buttons -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Update Customer
            </button>

            <a href="manage_customers.php" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php
// Include common footer
require __DIR__ . '/../footer.php';
?>
