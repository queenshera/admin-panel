# TextLocal Setup
Read up here for getting started and understanding the setup of TextLocal SMS service

## Configuration
- Ensure you have created Sender Id, SMS template and API key from TextLocal dashboard for sending SMS and OTPs.
- If you did not create it yet, you can do so by following [this](https://www.textlocal.in/how-to-guides/) guide.
- Add your TextLocal api key and default sender to .env file

## You can call any function of TextlocalHelper class to send message or OTP to user's mobile number

#### Send Message/s (This function is used to send message to any mobile number/s)
```
    $response = TextlocalHelper::sendMessage($numbers, $message);
//  $numbers is a single mobile number or list of mobile numbers with country code seperated by comma (+ is not required)
//  $message is a full message that we are sending to user.
```

#### Schedule Message/s (This function is used to schedule message to any mobile number/s)
```
    $response = TextlocalHelper::scheduleMessage($numbers, $message, $timestamp);
//  $numbers is a single mobile number or list of mobile numbers with country code seperated by comma (+ is not required)
//  $message is a full message that we are sending to user.
//  $timestamp is used to send future date and time in Unix timestamp format to schedule message sending
```

#### Get scheduled messages (This function is used to retrieve list of all scheduled messages)
```
    $response = TextlocalHelper::getScheduledMessages();
```

#### Cancel scheduled message (This function is used to cancel scheduled message using messageId)
```
    $response = TextlocalHelper::cancelScheduledMessages($messageId);
//  $messageId is unique id od scheduled message
```

#### Check account balance (This function is used to retrieve SMS balance in your Textlocal account)
```
    $response = TextlocalHelper::checkBalance();
```

#### Get SMS templates (This function is used to retrieve all sms templates linked to account)
```
    $response = TextlocalHelper::getTemplates();
```

#### Get senders (This function is used to retrieve list of all senders linked to account)
```
    $response = TextlocalHelper::getSenders();
```

#### Create short URL (This function is used to create short url of any webpage)
```
    $response = TextlocalHelper::createShortUrl($url);
//  $url is a full url of a webpage
```

