<?php

namespace Queenshera\AdminPanel\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class AppHelper
{
    public function retfloat($number,$decimals=2)
    {
        return number_format((float)$number, $decimals, '.', '');
    }

    public function formatCurrency(float $amount)
    {
        $value = number_format($amount, 2, '.', ',');

        return strtr('{SYMBOL} {VALUE}', [
            '{VALUE}' => $value,
            '{SYMBOL}' => '₹',
            '{CODE}' => 'rupee',
        ]);
    }

    public function getAmountInWords(float $amount)
    {
        $amount = number_format($amount, 2, '.', '');
        $formatter = new NumberFormatter($locale ?? App::getLocale(), NumberFormatter::SPELLOUT);

        $value = explode('.', $amount);

        $integer_value = (int)$value[0] !== 0 ? $formatter->format($value[0]) : 0;
        $fraction_value = isset($value[1]) ? $formatter->format($value[1]) : 0;

        return ucwords(sprintf('%s %s and %s %s', $integer_value, 'rupee', $fraction_value, 'paise'));
    }

    public function randomDigits($length=6)
    {
        return rand(pow(10, $length-1), pow(10, $length)-1);
    }

    public function randomid($length = 10, $upperCase = false)
    {
        if ($upperCase) {
            return strtoupper(substr(md5(time() * rand(1000000, 9999999)), 0, $length));
        }
        return substr(md5(time() * rand(1000000, 9999999)), 0, $length);
    }

    public function getMonthListFromToDate(Carbon $startDate, Carbon $endDate)
    {
        $startDate = $startDate->startOfMonth();
        $endDate   = $endDate->startOfMonth();

        do
        {
            $months[] = $startDate->format('F Y');
        } while ($startDate->addMonth() < $endDate);

        return $months;
    }

    public function uploadFileToLocal($file, $storagePath)
    {
        Storage::put('public/' . $storagePath, file_get_contents($file));
        $filePath = config('app.url') . '/storage/' . $storagePath;

        return $filePath;
    }

    public function uploadFileToS3($file, $storagePath)
    {
        Storage::disk('s3')->put($storagePath, file_get_contents($file));
        $filePath = config('filesystems.disks.s3.url') . $storagePath;

        return $filePath;
    }

}
