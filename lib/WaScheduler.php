<?php

class WaScheduler {

    public function run($db) {

        $notifier = new WaNotifier($db);
        $sender = new WaSender();

        $results = $notifier->getDueSoonMembers(7);

        while ($row = $results->fetch_assoc()) {

            $loan_id = $row['loan_id'];

            $exists = $db->query("SELECT id FROM wa_notifier_logs WHERE loan_id=$loan_id");

            if ($exists->num_rows == 0) {

                $message = $this->buildMessage($row);

                $sender->send('fonnte', normalize_phone($row['phone']), $message, []);

                $db->query("
                    INSERT INTO wa_notifier_logs
                    (member_id, loan_id, phone, message, provider, status, sent_at)
                    VALUES
                    ({$row['member_id']}, $loan_id, '{$row['phone']}', '$message', 'fonnte', 'sent', NOW())
                ");
            }
        }
    }

    private function buildMessage($data) {

        return "Halo {$data['member_name']},
Buku '{$data['title']}' akan jatuh tempo pada {$data['due_date']}.
Sisa {$data['remaining_days']} hari lagi.";
    }
}
