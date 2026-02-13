<?php
require 'whatsapp_notifier.plugin.php';

$config = new WaConfig($dbs);
$days = (int)$config->get('due_days');
$template = $config->get('message_template');
$providerName = $config->get('provider');

$checker = new DueChecker($dbs);
$queue = new QueueManager($dbs);

$results = $checker->getDueLoans($days);

while ($row = $results->fetch_assoc()) {

    $message = MessageBuilder::build($template, $row);

    $queue->addToQueue([
        'member_id' => $row['member_id'],
        'loan_id'   => $row['loan_id'],
        'phone'     => normalize_phone($row['phone']),
        'message'   => $message,
        'provider'  => $providerName
    ]);
}
