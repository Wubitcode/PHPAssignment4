<?php
require __DIR__ . '/../../db/database.php';

$firstName = $lastName = $email = $phone = $password = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstName']);
    $lastName  = trim($_POST['lastName']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $password  = trim($_POST['password']);

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        $error = "All fields including password are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare(
            "INSERT INTO technicians (firstName, lastName, email, phone, password) 
             VALUES (:firstName, :lastName, :email, :phone, :password)"
        );
        $stmt->execute([
            ':firstName' => $firstName,
            ':lastName'  => $lastName,
            ':email'     => $email,
            ':phone'     => $phone,
            ':password'  => $hashedPassword
        ]);
        $success = "Technician added successfully!";
        $firstName = $lastName = $email = $phone = $password = '';
    }
}

include __DIR__ . '/header.php';
?>

<div class="container mt-5">
    <h2>Add Technician</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="firstName" placeholder="First Name *" class="form-control mb-3" value="<?= htmlspecialchars($firstName) ?>">
        <input type="text" name="lastName" placeholder="Last Name *" class="form-control mb-3" value="<?= htmlspecialchars($lastName) ?>">
        <input type="email" name="email" placeholder="Email *" class="form-control mb-3" value="<?= htmlspecialchars($email) ?>">
        <input type="text" name="phone" placeholder="Phone" class="form-control mb-3" value="<?= htmlspecialchars($phone) ?>">
        <input type="password" name="password" placeholder="Password *" class="form-control mb-3">
        <button type="submit" class="btn btn-primary">Add Technician</button>
        <a href="manage_technicians.php" class="btn btn-secondary">Back to List</a>
    </form>
</div>

<?php include __DIR__ . '/footer.php'; ?>
