<h3>Notification Logs</h3>

<table class="table table-bordered">
<thead>
<tr>
    <th>Loan ID</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Type</th>
    <th>Date</th>
</tr>
</thead>
<tbody>

<?php
$res = $dbs->query("SELECT * FROM wa_notifier_queue ORDER BY created_at DESC LIMIT 50");

while($row = $res->fetch_assoc()):
?>

<tr>
    <td><?= $row['loan_id'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td>
        <?php if($row['status']=='sent'): ?>
            <span style="color:green;">Sent</span>
        <?php elseif($row['status']=='failed'): ?>
            <span style="color:red;">Failed</span>
        <?php else: ?>
            <span style="color:orange;">Pending</span>
        <?php endif; ?>
    </td>
    <td><?= $row['reminder_type'] ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>

<?php endwhile; ?>

</tbody>
</table>
