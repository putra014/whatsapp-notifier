
<?php

use SLiMS\Migration\Migration;

class CreateBase extends Migration
{
    function up()
    {
        \SLiMS\DB::getInstance()->query(<<<SQL
        CREATE TABLE IF NOT EXISTS wa_notifier_config (
    config_key VARCHAR(50) PRIMARY KEY,
    config_value TEXT
);

CREATE TABLE IF NOT EXISTS wa_notifier_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    loan_id INT,
    phone VARCHAR(20),
    message TEXT,
    provider VARCHAR(20),
    status ENUM('pending','processing','sent','failed') DEFAULT 'pending',
    attempt INT DEFAULT 0,
    last_error TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    processed_at DATETIME,
    UNIQUE KEY unique_loan (loan_id)
);

CREATE TABLE IF NOT EXISTS wa_notifier_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    queue_id INT,
    response TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE wa_notifier_queue
ADD COLUMN reminder_type ENUM('due_soon','overdue') DEFAULT 'due_soon',
ADD UNIQUE KEY unique_loan_type (loan_id, reminder_type);
SQL);
    }

    function down()
    {
        // tulis disini
    }
}
