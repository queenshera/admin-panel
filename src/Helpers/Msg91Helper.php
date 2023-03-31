<?php

namespace Queenshera\AdminPanel\Helpers;

class Msg91Helper
{
    public function sendMessage($templateId, $mobiles, $messageData)
    {
        $data['template_id'] = $templateId;
        $data['sender'] = config('msg91.sender');
        $data['short_url'] = '1';
        $data['mobiles'] = $mobiles;

        $data = array_merge($data, $messageData);

        $ch = curl_init(config('msg91.url') . 'flow');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept:application/json', 'authkey:' . config('msg91.key'), 'content-type:application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function sendOtp($templateId, $mobile, $otpLength = 4, $otp = null)
    {
        $data['template_id'] = $templateId;
        $data['sender'] = config('msg91.sender');
        $data['mobile'] = $mobile;
        $data['otp_length'] = $otpLength;
        $data['otp'] = $otp;

        $ch = curl_init(config('msg91.url') . 'otp');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept:application/json', 'authkey:' . config('msg91.key'), 'content-type:application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function resendOtp($mobile, $type = 'text')
    {
        $ch = curl_init(config('msg91.url') . 'otp/retry?mobile=' . $mobile . '&retrytype=' . $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept:application/json', 'authkey:' . config('msg91.key'), 'content-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function verifyOtp($mobile, $otp)
    {
        $ch = curl_init(config('msg91.url') . 'otp/verify?mobile=' . $mobile . '&otp=' . $otp);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept:application/json', 'authkey:' . config('msg91.key'), 'content-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }


}
