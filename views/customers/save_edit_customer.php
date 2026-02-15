<?php
declare(strict_types=1);
require __DIR__ . '/../../db/database.php';

// Get the customer ID
$customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
if (!$customerID) {
    header("Location: manage_customers.php?error=Invalid customer ID");
    exit;
}

// Collect all fields from the form
$fields = [];
foreach (['firstName','lastName','email','phone','address','city','state','postalCode','countryCode'] as $key) {
    $fields[$key] = trim($_POST[$key] ?? '');
    if ($fields[$key] === '') {
        header("Location: edit_customer.php?id=$customerID&error=Please fill all fields");
        exit;
    }
}

// Optional: validate email
if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: edit_customer.php?id=$customerID&error=Invalid email address");
    exit;
}

try {
    $stmt = $db->prepare("
        UPDATE customers
        SET firstName=:firstName,
            lastName=:lastName,
            email=:email,
            phone=:phone,
            address=:address,
            city=:city,
            state=:state,
            postalCode=:postalCode,
            countryCode=:countryCode
        WHERE customerID=:id
    ");
    $stmt->execute($fields + ['id' => $customerID]);

    // Redirect back to manage page with success message
    header("Location: manage_customers.php?success=Customer updated successfully");
    exit;

} catch (PDOException $e) {
    // Show detailed error for debugging (temporary)
    echo "<pre>Database Error: " . $e->getMessage() . "</pre>";
    echo "<pre>Data: " . print_r($fields, true) . "</pre>";
    exit;
}
