<?php

class DueChecker {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDueLoans($maxOverdueDays = 3) {

        $stmt = $this->db->prepare("
            SELECT l.loan_id, m.member_id, m.member_name, m.phone,
                   b.title, l.due_date,
                   DATEDIFF(l.due_date, CURDATE()) AS remaining_days
            FROM loan l
            JOIN member m ON l.member_id = m.member_id
            JOIN item i ON l.item_code = i.item_code
            JOIN biblio b ON i.biblio_id = b.biblio_id
            WHERE l.is_return = 0
            AND l.due_date BETWEEN CURDATE()
            AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
        ");

        $stmt->bind_param("i", $maxOverdueDays);
        $stmt->execute();

        return $stmt->get_result();
    }
}
