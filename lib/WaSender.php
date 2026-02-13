<?php

class WaSender {

    public function send($provider, $phone, $message, $config) {

        if ($provider == 'fonnte') {
            return $this->sendFonnte($phone, $message, $config);
        }

        if ($provider == 'whacenter') {
            return $this->sendWhacenter($phone, $message, $config);
        }

        return false;
    }

    private function sendFonnte($phone, $message, $config) {

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
                "Authorization: ".$config['api_key']
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private function sendWhacenter($phone, $message, $config) {

        $data = [
            'device_id' => $config['device_id'],
            'number' => $phone,
            'message' => $message
        ];

        $ch = curl_init("https://app.whacenter.com/api/send");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
