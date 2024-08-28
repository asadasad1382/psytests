<?php

namespace App\Helper;

class Helper
{
    const ADMINPATH = 'wa-admin';
    const BUYFROMRTL = true;
    const RTLSANDBOX = false;

    public static function numberFormatPrecision($number, $precision = 2, $separator = '.')
    {
        $number = \App\Helper\Helper::formatAmountWithNoE($number, $precision);
        $numberParts = explode($separator, $number);
        $response = $numberParts[0];
        if (count($numberParts) > 1 && $precision > 0) {
            $response .= $separator;
            $response .= substr($numberParts[1], 0, $precision);
        }
        return (float)$response;
    }

    public static function formatAmountWithNoE($amount, $decimal)
    {
        $amount = (string)$amount; // cast the number in string
        $pos = stripos($amount, 'E-'); // get the E- position
        $there_is_e = $pos !== false; // E- is found

        if ($there_is_e) {
            $decimals = intval(substr($amount, $pos + $decimal, strlen($amount))); // extract the decimals
            $amount = number_format($amount, $decimals, '.', ','); // format the number without E-
        }

        return $amount;
    }

    public static function getLocales()
    {
        return ['fa', 'en'];
    }

    public static function getCurrencies()
    {
        return [
            'Toman',
            'Usdt'
        ];
    }

    public static function encrypt($string, $key = 5): string
    {
        if ($string == "" || $string == null) {
            return "";
        }
        $result = '';
        for ($i = 0, $k = strlen($string); $i < $k; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }

    public static function decrypt($string, $key = 5)
    {
        $result = '';
        $string = base64_decode($string);
        for ($i = 0, $k = strlen($string); $i < $k; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }

    public static function calculateWage($amount)
    {
        $wage = 0;
        if ($amount > 0 && $amount <= 100000000) {
            $wage = 5000;
        }
        if ($amount > 100000000 && $amount <= 200000000) {
            $wage = 10000;
        }
        if ($amount > 200000000 && $amount <= 300000000) {
            $wage = 15000;
        }
        if ($amount > 300000000 && $amount <= 400000000) {
            $wage = 20000;
        }
        if ($amount > 400000000) {
            $wage = 25000;
        }
        return $wage;
    }

    public static function getSecurityType(): array
    {
        return ['sms', 'google', 'email'];
    }

    public static function getBroadcasterPrefix()
    {
        switch (env('BROADCAST_DRIVER')) {
            case 'redis':
                return env('APP_NAME') . '_database_';
            default:
                return '';
        }
    }
}
