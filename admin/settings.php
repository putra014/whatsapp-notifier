<?php
$config = new WaConfig($dbs);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $config->set('provider', $_POST['provider']);
    $config->set('api_key', $_POST['api_key']);
    $config->set('due_days', $_POST['due_days']);
    $config->set('message_template', $_POST['message_template']);

    $config->set('overdue_enabled', isset($_POST['overdue_enabled']) ? 1 : 0);
    $config->set('overdue_max_days', $_POST['overdue_max_days']);
    $config->set('overdue_template', $_POST['overdue_template']);

    echo "<div class='alert alert-success'>Settings saved</div>";
}
?>

<h3>WhatsApp Notifier Settings</h3>

<form method="post">

<label>Provider</label>
<select name="provider" class="form-control">
    <option value="fonnte">Fonnte</option>
    <option value="whacenter">Whacenter</option>
</select>

<label>API Key / Token</label>
<input type="text" name="api_key" class="form-control" required>

<label>Days Before Due</label>
<input type="number" name="due_days" class="form-control" value="7">

<hr>

<h4>Due Soon Template</h4>
<textarea name="message_template" class="form-control" rows="5">
Halo {nama},
Buku "{judul_buku}" akan jatuh tempo pada {due_date}.
Sisa {hari_tersisa} hari lagi.
</textarea>

<hr>

<h4>
<input type="checkbox" name="overdue_enabled"> Enable Overdue Reminder
</h4>

<label>Max Overdue Days</label>
<input type="number" name="overdue_max_days" class="form-control" value="3">

<h4>Overdue Template</h4>
<textarea name="overdue_template" class="form-control" rows="5">
Halo {nama},
Buku "{judul_buku}" sudah terlambat {hari_terlambat} hari.
Mohon segera dikembalikan.
</textarea>

<br>
<button type="submit" class="btn btn-primary">
    Save Settings
</button>

<button type="button" id="testConnection" class="btn btn-info">
    Test Connection
</button>

<div id="testResult" style="margin-top:10px;"></div>

</form>

<script src="../assets/script.js"></script>
