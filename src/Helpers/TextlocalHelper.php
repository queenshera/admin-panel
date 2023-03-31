<?php

namespace Queenshera\AdminPanel\Helpers;

class TextlocalHelper
{
    public function sendMessage($numbers, $message)
    {
        $message = rawurlencode($message);

        $data['apikey'] = config('textlocal.key');
        $data['sender'] = config('textlocal.sender');
        $data['numbers'] = $numbers;
        $data['message'] = $message;

        $ch = curl_init(config('textlocal.url') . 'send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function scheduleMessage($numbers, $message, $timestamp)
    {
        $message = rawurlencode($message);

        $data['apikey'] = config('textlocal.key');
        $data['sender'] = config('textlocal.sender');
        $data['numbers'] = $numbers;
        $data['message'] = $message;
        $data['schedule_time'] = $timestamp;

        $ch = curl_init(config('textlocal.url') . 'send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function checkBalance()
    {
        $data['apikey'] = config('textlocal.key');

        $ch = curl_init(config('textlocal.url') . 'balance');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function getTemplates()
    {
        $data['apikey'] = config('textlocal.key');

        $ch = curl_init(config('textlocal.url') . 'get_templates');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function getSenders()
    {
        $data['apikey'] = config('textlocal.key');

        $ch = curl_init(config('textlocal.url') . 'get_sender_names');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function getScheduledMessages()
    {
        $data['apikey'] = config('textlocal.key');

        $ch = curl_init(config('textlocal.url') . 'get_scheduled');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function cancelScheduledMessages($messageId)
    {
        $data['apikey'] = config('textlocal.key');
        $data['sent_id'] = $messageId;

        $ch = curl_init(config('textlocal.url') . 'cancel_scheduled');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function createShortUrl($url)
    {
        $data['apikey'] = config('textlocal.key');
        $data['url'] = $url;

        $ch = curl_init(config('textlocal.url') . 'create_shorturl');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}
