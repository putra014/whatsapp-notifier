<?php
/**
 * Plugin Name: WhatsApp-Notifer
 * Plugin URI: <url untuk mengunduh plugin ini>
 * Description: <deskripsi plugin>
 * Version: 1.0.0
 * Author: Zakaria Saputra
 * Author URI: <Alamat Media Sosial Pembuat Plugin>
 */
use SLiMS\Plugins;
$plugins = Plugins::getInstance();

$plugins->registerMenu('bibliography', 'whatsapp-notifier', __DIR__ . '/index.php');

require_once __DIR__.'/lib/WaNotifier.php';
require_once __DIR__.'/lib/WaSender.php';
require_once __DIR__.'/lib/WaScheduler.php';


// function db_connect() {
//     global $dbs;
//     $sql = mysqli_connect(__DIR__.'config/database.php');
//     $dbs->query($sql);
// }

// db_connect();