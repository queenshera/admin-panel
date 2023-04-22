<?php

namespace Queenshera\AdminPanel\Helpers;

/**
 * This class is used to send message, schedule message on Textlocal platform
 */

class TextlocalHelper
{
    /**
     * This function is used to send message
     *
     * @param $numbers
     * @param $message
     * @return mixed
     */
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

    /**
     * This function is used to schedule message send
     * @param $numbers
     * @param $message
     * @param $timestamp
     * @return mixed
     */
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

    /**
     * This function is used to check balance remaining in account
     *
     * @return mixed
     */
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

    /**
     * This function is used to get list of message templates
     *
     * @return mixed
     */
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

    /**
     * This function is used to get list of senders
     *
     * @return mixed
     */
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

    /**
     * This function is used to get list of scheduled messages
     *
     * @return mixed
     */
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

    /**
     * This function is used to cancel scheduled message
     *
     * @param $messageId
     * @return mixed
     */
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

    /**
     * This function is used to create short url of given url
     * @param $url
     * @return mixed
     */
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
