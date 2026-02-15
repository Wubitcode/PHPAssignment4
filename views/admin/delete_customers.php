<?php
// Include the database connection file
// This file creates the $db PDO object
require __DIR__ . '/../../db/database.php';

// Get the customer ID from the URL (?id=)
// FILTER_VALIDATE_INT ensures the value is a valid integer
$customerID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// If the ID is missing or invalid, redirect back with an error
if (!$customerID) {
    header("Location: manage_customers.php?error=Invalid customer ID");
    exit;
}

try {
    // Prepare a SQL statement to delete a customer by ID
    // Using a prepared statement prevents SQL injection
    $stmt = $db->prepare(
        "DELETE FROM customers WHERE customerID = :id"
    );

    // Execute the prepared statement with the customer ID
    $stmt->execute([
        'id' => $customerID
    ]);

    // Redirect back to the manage customers page with a success message
    header("Location: manage_customers.php?success=Customer deleted successfully");
    exit;

} catch (PDOException $e) {
    // If a database error occurs, redirect with an error message
    // (Do not display raw database errors to users)
    header("Location: manage_customers.php?error=Database error");
    exit;
}
