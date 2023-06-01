# File Upload Setup
Read up here for getting started and understanding the setup of AWS S3 service

## Configuration for AWS
- Ensure you have created storage bucket, access key and secret key from AWS dashboard.
- If you did not create it yet, you can do so by following [this](https://docs.aws.amazon.com/powershell/latest/userguide/pstools-appendix-sign-up.html) guide.
- Add your AWS details to .env file

## Uploading files to storage
- You can upload files to local storage or S3 storage by calling a function.
- File uploading to local storage or AWS S3 will depend on value of AWS_ENABLED provided in .env file

#### Upload files to storage
```
    $response = \Queenshera\AdminPanel\Helpers\AppHelper::uploadFileToStorage($file, $fileNamePath);
//  $file is the raw that is coming directly from HTML form
//  $fileNamePath is path of file storage including file name and extension
```
