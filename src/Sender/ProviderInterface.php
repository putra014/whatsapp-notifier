<?php

interface ProviderInterface {
    public function send($phone, $message);
}
