<?php

class MessageBuilder {

    public static function build($template, $data) {

        $replacements = [
            '{nama}' => $data['member_name'],
            '{judul_buku}' => $data['title'],
            '{due_date}' => $data['due_date'],
            '{hari_terlambat}' => $data['overdue_days']
        ];

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            $template
        );
    }
}
