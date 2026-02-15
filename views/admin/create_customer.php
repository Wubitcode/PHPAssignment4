<?php
// Include database connection (PDO)
require __DIR__ . '/../../db/database.php';

// Initialize an empty array to store sanitized form values
$fields = [];

// Loop through expected customer fields
foreach ([
    'firstName',
    'lastName',
    'email',
    'phone',
    'address',
    'city',
    'state',
    'postalCode',
    'countryCode'
] as $key) {

    // Get POST value, trim whitespace, or default to empty string
    $fields[$key] = trim($_POST[$key] ?? '');

    // Validate: all fields are required
    if ($fields[$key] === '') {
        // Redirect back to add form with error message
        header("Location: add_customer.php?error=Please fill all fields");
        exit;
    }
}

// Validate email format
if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
    // Redirect if email is invalid
    header("Location: add_customer.php?error=Invalid email");
    exit;
}

try {
    // Prepare SQL INSERT statement using named placeholders
    $stmt = $db->prepare("
        INSERT INTO customers
        (firstName, lastName, email, phone, address, city, state, postalCode, countryCode)
        VALUES
        (:firstName, :lastName, :email, :phone, :address, :city, :state, :postalCode, :countryCode)
    ");

    // Execute prepared statement with sanitized data
    $stmt->execute($fields);

    // Redirect to manage customers page on success
    header("Location: manage_customers.php?success=Customer added successfully");
    exit;

} catch (PDOException $e) {
    // Handle database errors (hidden from users for security)
    header("Location: add_customer.php?error=Database error");
    exit;
}
