<?php
// Include database connection (PDO)
require __DIR__ . '/../../db/database.php';

// Include shared header (Bootstrap, navigation, etc.)
require __DIR__ . '/../header.php';

// Define all customer form fields with default empty values
// This makes it easy to loop and generate inputs dynamically
$fields = [
    'firstName'   => '',
    'lastName'    => '',
    'email'       => '',
    'phone'       => '',
    'address'     => '',
    'city'        => '',
    'state'       => '',
    'postalCode'  => '',
    'countryCode' => ''
];

// Get error message from URL if validation fails
$error = $_GET['error'] ?? '';
?>

<div class="container mt-4">
    <h2 class="mb-3">Add Customer</h2>

    <!-- Display validation or database error message if present -->
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Add customer form -->
    <form method="post" action="create_customer.php" class="card p-3 shadow-sm">

        <!-- Generate input fields dynamically -->
        <?php foreach ($fields as $key => $value): ?>
            <div class="mb-3">
                <!-- Capitalize field label -->
                <label class="form-label"><?= ucfirst($key) ?></label>

                <!-- Input field with required validation -->
                <input
                    name="<?= $key ?>"
                    class="form-control"
                    required
                    value="<?= htmlspecialchars($value) ?>">
            </div>
        <?php endforeach; ?>

        <!-- Form action buttons -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Add Customer
            </button>

            <a href="manage_customers.php" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php
// Include shared footer
require __DIR__ . '/../footer.php';
?>
