<?php
require __DIR__ . '/../../db/database.php';

$query = "SELECT techID, firstName, lastName FROM technicians ORDER BY lastName";
$stmt = $db->query($query);
$technicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Select Technician</h2>

<form method="post" action="incident_list.php">
    <select name="techID">
        <?php foreach ($technicians as $tech): ?>
            <option value="<?= $tech['techID'] ?>">
                <?= $tech['firstName'] . ' ' . $tech['lastName'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Select</button>
</form>
