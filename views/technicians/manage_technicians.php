<?php
require __DIR__ . '/../../db/database.php';

// Fetch all technicians
$sql = "SELECT techID, firstName, lastName, email, phone FROM technicians";
$technicians = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../header.php';
?>

<h2 class="mb-3">Add Technician</h2>
<form action="add_technician.php" method="post" class="mb-4">
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="firstName" class="form-control" placeholder="First Name *" required>
        </div>
        <div class="col">
            <input type="text" name="lastName" class="form-control" placeholder="Last Name *" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input type="email" name="email" class="form-control" placeholder="Email *" required>
        </div>
        <div class="col">
            <input type="text" name="phone" class="form-control" placeholder="Phone">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Add Technician</button>
</form>

<h2 class="mb-3">Technician List</h2>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($technicians as $tech): ?>
            <tr>
                <td><?= $tech['techID'] ?></td>
                <td><?= htmlspecialchars($tech['firstName']) ?></td>
                <td><?= htmlspecialchars($tech['lastName']) ?></td>
                <td><?= htmlspecialchars($tech['email']) ?></td>
                <td><?= htmlspecialchars($tech['phone']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../footer.php'; ?>
