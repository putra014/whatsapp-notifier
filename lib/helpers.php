<?php

function normalize_phone($phone) {

    $phone = preg_replace('/[^0-9]/', '', $phone);

    if (substr($phone, 0, 2) == '08') {
        return '62' . substr($phone, 1);
    }

    if (substr($phone, 0, 1) == '+') {
        return substr($phone, 1);
    }

    return $phone;
}
