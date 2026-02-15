<?php
require __DIR__ . '/../../db/database.php';
require __DIR__ . '/../header.php';

$searchName = trim($_POST['lastName'] ?? '');

if ($searchName !== '') {
    $stmt = $db->prepare("SELECT * FROM customers WHERE lastName LIKE ?");
    $stmt->execute(["%$searchName%"]);
} else {
    $stmt = $db->query("SELECT * FROM customers ORDER BY lastName, firstName");
}
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Messages
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';
?>

<div class="container mt-4">
    <h2 class="mb-4">Manage Customers</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="post" class="d-flex gap-2">
            <input type="text" name="lastName" class="form-control" placeholder="Search by Last Name" value="<?= htmlspecialchars($searchName) ?>">
            <button class="btn btn-primary">Search</button>
        </form>
        <a href="add_customer.php" class="btn btn-success">Add Customer</a>
    </div>

    <?php if ($customers): ?>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['customerID']) ?></td>
                <td><?= htmlspecialchars($customer['firstName']) ?></td>
                <td><?= htmlspecialchars($customer['lastName']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td><?= htmlspecialchars($customer['phone']) ?></td>
                <td><?= htmlspecialchars($customer['city']) ?></td>
                <td>
                    <a href="../customers/edit_customer.php?id=<?= $customer['customerID'] ?>" class="btn btn-sm btn-warning">Edit</a>

                    <a href="delete_customer.php?id=<?= $customer['customerID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-warning">No customers found.</div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
