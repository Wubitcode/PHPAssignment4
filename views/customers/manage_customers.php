<?php
/**
 * This page displays:
 * 1) A form to add a new customer (basic fields)
 * 2) A table listing all existing customers
 */

// Enable error reporting for development/debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection (creates $db PDO object)
require __DIR__ . '/../../db/database.php';

// Include common header (HTML head, navbar, Bootstrap, etc.)
require __DIR__ . '/../header.php';

/**
 * Fetch all customers from the database
 * Only basic fields are selected for display
 * Ordered by newest customer first
 */
$sql = "
    SELECT customerID, firstName, lastName, email, phone
    FROM customers
    ORDER BY customerID DESC
";

// Execute query and fetch results as associative array
$customers = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ================= ADD CUSTOMER FORM ================= -->

<h2 class="mb-3">Add Customer</h2>

<!--
    This form submits customer data to add_customer.php
    Required fields are validated by HTML and server-side logic
-->
<form action="../admin/add_customer.php" method="post" class="mb-4">

    <!-- First Name & Last Name -->
    <div class="row mb-3">
        <div class="col">
            <input type="text"
                   name="firstName"
                   class="form-control"
                   placeholder="First Name *"
                   required>
        </div>
        <div class="col">
            <input type="text"
                   name="lastName"
                   class="form-control"
                   placeholder="Last Name *"
                   required>
        </div>
    </div>

    <!-- Email & Phone -->
    <div class="row mb-3">
        <div class="col">
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Email *"
                   required>
        </div>
        <div class="col">
            <input type="text"
                   name="phone"
                   class="form-control"
                   placeholder="Phone">
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        Add Customer
    </button>
</form>

<hr>

<!-- ================= CUSTOMER LIST TABLE ================= -->

<h2 class="mb-3">Customer List</h2>

<!--
    Display customers in a Bootstrap-styled table
    If no customers exist, show a friendly message
-->
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>

        <!-- If no customers are found -->
        <?php if (empty($customers)): ?>
            <tr>
                <td colspan="4" class="text-center">
                    No customers found
                </td>
            </tr>

        <!-- Loop through customers and display each row -->
        <?php else: ?>
            <?php foreach ($customers as $c): ?>
                <tr>
                    <td><?= $c['customerID'] ?></td>
                    <td><?= htmlspecialchars($c['firstName'] . ' ' . $c['lastName']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    </tbody>
</table>

<?php
// Include common footer (closing tags, scripts)
require __DIR__ . '/../footer.php';
?>
