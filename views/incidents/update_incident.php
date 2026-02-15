<?php
require __DIR__ . '/../../db/database.php';

// Fetch incidents assigned to current technician (or all if admin)
$incidents = $db->query("SELECT i.incidentID, i.title, i.description, i.dateClosed,
    c.firstName AS customerFirst, c.lastName AS customerLast
    FROM incidents i
    JOIN customers c ON i.customerID = c.customerID
    WHERE i.dateClosed IS NULL")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../header.php';
?>

<h2 class="mb-3">Update Incident</h2>
<?php if (empty($incidents)): ?>
    <p class="text-muted">No open incidents to update.</p>
<?php else: ?>
    <form action="save_update.php" method="post">
        <div class="mb-3">
            <label class="form-label">Select Incident *</label>
            <select name="incidentID" class="form-select" required>
                <option value="">Select Incident</option>
                <?php foreach ($incidents as $i): ?>
                    <option value="<?= $i['incidentID'] ?>">
                        <?= htmlspecialchars($i['title'] . ' - ' . $i['customerFirst'] . ' ' . $i['customerLast']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Close Date</label>
            <input type="date" name="dateClosed" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update Incident</button>
    </form>
<?php endif; ?>

<?php include __DIR__ . '/../footer.php'; ?>
