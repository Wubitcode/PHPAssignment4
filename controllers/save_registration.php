<?php
//  Display all PHP errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

//  Start session to access logged-in customer info
session_start();

//  Include database connection
require_once __DIR__ . '/../db/database.php';

//  Check if the customer is logged in
if (!isset($_SESSION['customer'])) {
    // Redirect to login page if not logged in
    header("Location: /PHPAssignment4/views/registrations/customer_login.php");
    exit; // Stop script execution after redirect
}

//  Get customerID from session
$customerID = $_SESSION['customer']['customerID'];

//  Get the selected product code from POST data
$productCode = trim($_POST['productCode'] ?? '');

//  Validate that a product was selected
if (!$productCode) {
    // Redirect back with error status if no product selected
    header("Location: /PHPAssignment4/views/registrations/register_product.php?status=error");
    exit;
}

try {
    //  Prepare SQL statement to insert registration
    $stmt = $db->prepare(
        "INSERT INTO registrations (customerID, productCode, registrationDate)
         VALUES (:customerID, :productCode, NOW())"
    );

    //  Execute the statement with bound values
    $stmt->execute([
        'customerID' => $customerID,
        'productCode' => $productCode
    ]);

    //  Registration successful
    // Redirect to register_product page with success status and product code for message
    header("Location: /PHPAssignment4/views/registrations/register_product.php?status=success&code=" . urlencode($productCode));
    exit;

} catch (PDOException $e) {
    //  Handle duplicate entry (customer already registered this product)
    if ($e->getCode() == 23000) {
        header("Location: /PHPAssignment4/views/registrations/register_product.php?status=duplicate");
        exit;
    } else {
        //  Any other database error
        echo "Database Error: " . $e->getMessage();
        exit;
    }
}
