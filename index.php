<?php
defined('INDEX_AUTH') OR die('Direct access not allowed!');

$page = $_GET['page'] ?? 'settings';

switch ($page) {
    case 'manual':
        require 'admin/manual.php';
        break;

    case 'logs':
        require 'admin/logs.php';
        break;

    default:
        require 'admin/settings.php';
}

?>