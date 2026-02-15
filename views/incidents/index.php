<?php
// index.php for incidents
// Display all incidents with assigned technicians

require __DIR__ . '/../../db/database.php';

$sql = "SELECT i.incidentID, i.title, i.description, i.dateOpened, i.dateClosed,
        c.firstName AS custFirst, c.lastName AS custLast,
        t.firstName AS techFirst, t.lastName AS techLast,
        p.name AS productName
        FROM incidents i
        JOIN customers c ON i.customerID = c.customerID
        JOIN products p ON i.productCode = p.productCode
        LEFT JOIN technicians t ON i.techID = t.techID
        ORDER BY i.dateOpened DESC";

$incidents = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../header.php';
?>

<h2 class="mb-3">Incidents List</h2>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Technician</th>
            <th>Date Opened</th>
            <th>Date Closed</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($incidents): ?>
            <?php foreach ($incidents as $incident): ?>
                <tr>
                    <td><?= htmlspecialchars($incident['title']) ?></td>
                    <td><?= htmlspecialchars($incident['custFirst'] . ' ' . $incident['custLast']) ?></td>
                    <td><?= htmlspecialchars($incident['productName']) ?></td>
                    <td><?= $incident['techFirst'] ? htmlspecialchars($incident['techFirst'] . ' ' . $incident['techLast']) : '-' ?></td>
                    <td><?= $incident['dateOpened'] ?></td>
                    <td><?= $incident['dateClosed'] ?: '-' ?></td>
                    <td>
                        <a href="update_incident.php?id=<?= $incident['incidentID'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_incident.php?id=<?= $incident['incidentID'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">No incidents found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../footer.php'; ?>
