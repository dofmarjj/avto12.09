<?php

class TelegramNotice {

    private $token = '6339618411:AAGGRc1xyAZV62kYA2oSOruF2L9LroJ_BMU';
    private $chatId = '-901361781';

    public function send(array $attributes)
    {
        
        $message = '';
        foreach ($attributes as $key => $value) {
            $message .= "{$key}: {$value}\n";
        }
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage";
        $data = array(
            "chat_id" => $this->chatId,
            "text" => $message
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;

    $attributes = [
        'name' => $post['name'] ?? '-',
        'phone' => $post['phone'] ?? '-',
        'usluga' => $post['usluga'] ?? '-',
        'brand' => $post['brand'] ?? '-',
        'model' => $post['model'] ?? '-',
        'year' => $post['year'] ?? '-',
        'comment' => $post['comment'] ?? '-',
        'form' => $post['form'] ?? '-',
    ];

    // try {
        (new TelegramNotice())->send($attributes);
    // } catch (Exception $exception) {

    // }
}

header('Location: http://www.avto-vukyp.com.ua');
exit;
