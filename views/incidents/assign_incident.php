<?php
require __DIR__ . '/../../db/database.php';

// Fetch incidents that have no technician assigned
$incidents = $db->query("SELECT incidentID, title FROM incidents WHERE techID IS NULL")->fetchAll(PDO::FETCH_ASSOC);

// Fetch technicians
$technicians = $db->query("SELECT techID, firstName, lastName FROM technicians")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../header.php';
?>

<h2 class="mb-3">Assign Incident</h2>
<form action="update_assign.php" method="post" class="mb-4">
    <div class="mb-3">
        <label class="form-label">Incident *</label>
        <select name="incidentID" class="form-select" required>
            <option value="">Select Incident</option>
            <?php foreach ($incidents as $i): ?>
                <option value="<?= $i['incidentID'] ?>"><?= htmlspecialchars($i['title']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Technician *</label>
        <select name="techID" class="form-select" required>
            <option value="">Select Technician</option>
            <?php foreach ($technicians as $t): ?>
                <option value="<?= $t['techID'] ?>"><?= htmlspecialchars($t['firstName'] . ' ' . $t['lastName']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Assign Technician</button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>
