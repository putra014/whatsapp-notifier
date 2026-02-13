<?php

class FonnteProvider implements ProviderInterface {

    private $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function send($phone, $message) {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $phone,
                'message' => $message
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->token"
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
