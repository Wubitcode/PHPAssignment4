<?php
// Start the session to access session variables
session_start();

//  Redirect to login page if customer is not logged in
if (!isset($_SESSION['customer'])) {
    header("Location: /PHPAssignment4/views/registrations/customer_login.php");
    exit(); // Stop script execution after redirect
}

//  Include database connection
require_once __DIR__ . '/../../db/database.php';

//  Include product model functions (get_products)
require_once __DIR__ . '/../../models/product_db.php';

//  Store logged-in customer info in a variable
$customer = $_SESSION['customer'];

//  Fetch all products from database
$products = get_products();

// ================= Status Messages =================
//  Retrieve status and product code from URL query parameters
$status = $_GET['status'] ?? '';
$productCodeMsg = $_GET['code'] ?? '';

$message = '';      // Message to display to user
$alertClass = '';   // Bootstrap alert class (success, warning, etc.)

//  Determine which message to show based on status
switch ($status) {
    case 'success':
        // Successful registration
        $message = "Product registered successfully! Product Code: " . htmlspecialchars($productCodeMsg);
        $alertClass = "success";
        break;

    case 'duplicate':
        // User already registered this product
        $message = "You have already registered this product.";
        $alertClass = "warning";
        break;

    case 'error':
        // No product selected
        $message = "Please select a product.";
        $alertClass = "warning";
        break;
}

//  Include the page header
include __DIR__ . '/../header.php';
?>

<div class="container mt-4">

    <!-- Page title -->
    <h2>Register Product</h2>

    <!--  Display message if it exists -->
    <?php if ($message): ?>
        <div class="alert alert-<?= $alertClass ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <!--  Show logged-in customer's name -->
    <p>
        <strong>Customer:</strong>
        <?= htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName']) ?>
    </p>

    <!--  Product Registration Form -->
    <form method="POST" action="/PHPAssignment4/controllers/save_registration.php">

        <!--  Hidden input to pass customerID to controller -->
        <input type="hidden" name="customerID"
               value="<?= htmlspecialchars($customer['customerID']) ?>">

        <div class="mb-3">
            <label class="form-label">Product *</label>

            <!--  Dropdown to select product -->
            <select name="productCode" class="form-select" required>
                <option value="">-- Select Product --</option>

                <!--  Loop through products and display as options -->
                <?php foreach ($products as $product): ?>
                    <option value="<?= htmlspecialchars($product['productCode']) ?>">
                        <?= htmlspecialchars($product['name']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <!--  Submit button -->
        <button type="submit" class="btn btn-success">
            Register Product
        </button>

    </form>

</div>

<!--  Include the page footer -->
<?php include __DIR__ . '/../footer.php'; ?>
