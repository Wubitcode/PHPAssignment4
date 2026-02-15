<?php
//  Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//  Start session to manage logged-in customer
session_start();

//  Include database connection and model files
require_once __DIR__ . '/../db/database.php';
require_once __DIR__ . '/../models/customer_db.php';
require_once __DIR__ . '/../models/product_db.php';
require_once __DIR__ . '/../models/registration_db.php';

//  Determine the action: check POST first, then GET
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action');

//  Handle different actions using a switch statement
switch ($action) {

    //  CUSTOMER LOGIN
    case 'login_customer':
        // Get the email from the login form
        $email = filter_input(INPUT_POST, 'email');

        // Fetch customer data from database by email
        $customer = get_customer_by_email($email);

        if ($customer) {
            // If customer exists, store info in session
            $_SESSION['customer'] = $customer;

            // Redirect to the product registration page
            header("Location: ../views/registrations/register_product.php");
            exit(); // Stop further execution after redirect
        } else {
            // If customer not found, show login page with error
            $error = "Customer not found.";
            include __DIR__ . '/../views/registrations/customer_login.php';
        }
        break;

    //  ADD PROJECT (admin functionality)
    case 'add':
        // Get POST data from form
        $name = trim($_POST['name'] ?? '');
        $version = trim($_POST['version'] ?? '');
        $releaseDate = $_POST['releaseDate'] ?? null;

        // Validate input
        if ($name && $version && $releaseDate) {
            // Prepare SQL statement to insert new product
            $stmt = $db->prepare(
                "INSERT INTO products (name, version, releaseDate)
                 VALUES (:name, :version, :releaseDate)"
            );
            // Bind values to prevent SQL injection
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':version', $version);
            $stmt->bindValue(':releaseDate', $releaseDate);
            $stmt->execute(); // Execute insertion
        }

        // Redirect to admin project manager page after adding
        header("Location: ../views/admin/project_manager.php");
        exit(); // Stop further execution

    //  DEFAULT ACTION
    default:
        // If no action specified, show the product registration page
        include __DIR__ . '/../views/registrations/register_product.php';
}
