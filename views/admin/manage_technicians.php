<?php
require __DIR__ . '/../../db/database.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
    $id = (int) $_GET['delete_id'];
    $stmt = $db->prepare("DELETE FROM technicians WHERE techID = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    header("Location: manage_technicians.php");
    exit;
}

// Fetch all technicians
$techStmt = $db->query("SELECT techID, firstName, lastName, email, phone, password FROM technicians");
$technicians = $techStmt->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../header.php'; // Correct path
?>

<div class="container mt-5">
    <h2>Technician List</h2>

    <!-- Technicians Table -->
    <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>Delete</th>
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
                    <td>********</td>
                    <td>
                        <a href="manage_technicians.php?delete_id=<?= $tech['techID'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this technician?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add Technician Button -->
    <div class="mt-3">
        <a href="add_technician.php" class="btn btn-primary">Add Technician</a>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
