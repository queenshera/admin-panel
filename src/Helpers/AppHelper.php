<?php

namespace Queenshera\AdminPanel\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use NumberFormatter;

/**
 * This class is used to execute multiple times used general functions
 */
class AppHelper
{
    /**
     * This function is used to convert any number to float with specific number after decimal point.
     * By default, two numbers are taken after decimal point.
     *
     * @param $number
     * @param $decimals
     * @return string
     */
    public static function retfloat($number, $decimals = 2)
    {
        return number_format((float)$number, $decimals, '.', '');
    }

    /**
     * This function is used to convert amount to Indian currency in numbers
     *
     * @param float $amount
     * @return string
     */
    public static function formatCurrency(float $amount)
    {
        $value = number_format($amount, 2, '.', ',');

        return strtr('{SYMBOL} {VALUE}', [
            '{VALUE}' => $value,
            '{SYMBOL}' => '₹',
            '{CODE}' => 'rupee',
        ]);
    }

    /**
     * This function is used to convert amount to Indian currency in words
     *
     * @param float $amount
     * @return string
     */
    public static function getAmountInWords(float $amount)
    {
        $amount = number_format($amount, 2, '.', '');
        $formatter = new NumberFormatter($locale ?? App::getLocale(), NumberFormatter::SPELLOUT);

        $value = explode('.', $amount);

        $integer_value = (int)$value[0] !== 0 ? $formatter->format($value[0]) : 0;
        $fraction_value = isset($value[1]) ? $formatter->format($value[1]) : 0;

        return ucwords(sprintf('%s %s and %s %s', $integer_value, 'rupee', $fraction_value, 'paise'));
    }

    /**
     * This function is used to generate random numbers
     * By default length is defined as 6. But, developer can specify any length according to requirement.
     *
     * @param $length
     * @return int
     */
    public static function randomDigits($length = 6)
    {
        return rand(pow(10, $length - 1), pow(10, $length) - 1);
    }

    /**
     * This function is used to generate timestamp based random alphanumeric string
     * By default length is defined as 10. But, developer can specify any length according to requirement.
     *
     * @param $length
     * @param $upperCase
     * @return string
     */
    public static function randomid($length = 10, $upperCase = false)
    {
        if ($upperCase) {
            return strtoupper(substr(md5(time() * rand(1000000, 9999999)), 0, $length));
        }
        return substr(md5(time() * rand(1000000, 9999999)), 0, $length);
    }

    /**
     * This function is used to get list of months between two carbon dates
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return array
     */
    public static function getMonthListFromToDate(Carbon $startDate, Carbon $endDate)
    {
        $startDate = $startDate->startOfMonth();
        $endDate = $endDate->startOfMonth();

        do {
            $months[] = $startDate->format('F Y');
        } while ($startDate->addMonth() < $endDate);

        return $months;
    }

    /**
     * This function is used to upload file to storage depending on value of aws enablement status
     *
     * @param $file
     * @param $fileNamePath
     * @return string
     */
    public static function uploadFileToStorage($file, $fileNamePath)
    {
        if (config('filesystems.disks.s3.enabled')) {
            $file->storeAs('', $fileNamePath, 's3');
            return config('filesystems.disks.s3.url') . $fileNamePath;
        }

        $file->storePubliclyAs('public', $fileNamePath);
        return config('app.url') . '/storage/' . $fileNamePath;
    }

}
