<?php

namespace Queenshera\AdminPanel\Helpers;

use Illuminate\Support\Facades\App;
use NumberFormatter;

class AppHelper
{
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

    public function randomid($length = 10, $upperCase = false)
    {
        if ($upperCase) {
            return strtoupper(substr(md5(time() * rand(1000000, 9999999)), 0, $length));
        }
        return substr(md5(time() * rand(1000000, 9999999)), 0, $length);
    }

}
