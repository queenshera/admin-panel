# MSG91 Setup
Read up here for getting started and understanding the setup of msg91 SMS service

## Configuration
- Ensure you have created Sender Id, SMS template and API key from MSG91 dashboard for sending SMS and OTPs.
- If you did not create it yet, you can do so by following [this](https://msg91.com/help/MSG91/step-by-step-process-to-configure-sms) guide.
- Add your msg91 api key and default sender to .env file

## Using MSG91
### Create object of Msg91Helper class
```
$msg91Helper = new \Queenshera\AdminPanel\Helpers\Msg91Helper();
```
### Now you can call any function of Msg91Helper class using this object

#### Send Message/s (This function is used to send message to any mobile number/s)
```
    $response = $msg91Helper->sendMessage($templateId, $mobiles, $messageData);
//  $templateId is the ID of template that we got from msg91 dashboard
//  $mobiles is a single mobile number or list of mobile numbers with country code seperated by comma (+ is not required)
//  $messageData is json object of template variable and its value in format of {"var1":"val1","var2":"val2","var3":"val3"}
```

#### Send OTP (This function is used to send otp on given mobile number)
```
    $response = $msg91Helper->sendOtp($templateId, $mobile, $otpLength = 4, $otp = null);
//  $templateId is the ID of template that we got from msg91 dashboard
//  $mobile is a mobile number with country code (+ is not required)
//  $otpLength is the number of digits in OTP (default : 4, min : 4, max : 9)
//  $otp is an OTP you want to send. If you don't pass this value, it will be automatically generated
```

#### Verify OTP (This function is used to verify otp sent on mobile number)
```
    $response = $msg91Helper->verifyOtp($mobile, $otp);
//  $mobile is a mobile number with country code (+ is not required)
//  $otp is an OTP that is received on users mobile number.
```

#### Resend OTP (This function is used to resend otp on given mobile number)
```
    $response = $msg91Helper->resendOtp($mobile, $type = 'text');
//  $mobile is a mobile number with country code (+ is not required)
//  $type is retry type that is used to resend otp on users mobile number. By default, we set it as text. For voice call we can use 'Voice'
```

