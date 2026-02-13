<?php

class WaNotifier {

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDueSoonMembers($days = 7) {

        $query = "
            SELECT l.loan_id, m.member_id, m.member_name, m.phone,
                   b.title, l.due_date,
                   DATEDIFF(l.due_date, CURDATE()) AS remaining_days
            FROM loan AS l
            JOIN member AS m ON l.member_id = m.member_id
            JOIN item AS i ON l.item_code = i.item_code
            JOIN biblio AS b ON i.biblio_id = b.biblio_id
            WHERE l.is_return = 0
            AND l.due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL {$days} DAY)
        ";

        return $this->db->query($query);
    }
}
