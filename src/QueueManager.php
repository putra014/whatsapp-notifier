<?php

class QueueManager {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addToQueue($data) {

        $stmt = $this->db->prepare("
            INSERT IGNORE INTO wa_notifier_queue
            (member_id, loan_id, phone, message, provider,)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "iisss",
            $data['member_id'],
            $data['loan_id'],
            $data['phone'],
            $data['message'],
            $data['provider']
        );

        return $stmt->execute();
    }

    public function getPending($limit = 10) {

        return $this->db->query("
            SELECT * FROM wa_notifier_queue
            WHERE status='pending'
            LIMIT $limit
        ");
    }
}
