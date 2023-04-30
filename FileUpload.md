# AWS S3 Setup
Read up here for getting started and understanding the setup of AWS S3 service

## Configuration
- Ensure you have created storage bucket, access key and secret key from AWS dashboard.
- If you did not create it yet, you can do so by following [this](https://msg91.com/help/MSG91/step-by-step-process-to-configure-sms) guide.
- Add your AWS details to .env file

## Using AWS S3 storage
### Create object of AppHelper class
```
$appHelper = new \Queenshera\AdminPanel\Helpers\AppHelper();
```
### Now you can call any function of AppHelper class using this object 

#### Upload files to AWS storage
```
    $response = $appHelper->uploadFileToS3($file, $fileNamePath);
//  $file is the raw that is coming directly from HTML form
//  $fileNamePath is path of file storage including file name and extension
```

#### Upload files to local storage
```
    $response = $appHelper->uploadFileToLocal($file, $fileNamePath);
//  $file is the raw that is coming directly from HTML form
//  $fileNamePath is path of file storage including file name and extension
```
