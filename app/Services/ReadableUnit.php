<?php

namespace App\Services;

class ReadableUnit
{

    /**
     * Conditional formats a number to display the quantity. 
     * 
     * @return number
     */
    public static function quantity($number)
    {
        $int = intval($number);
        return ($number == $int) ? $int : round($number, 2);
    }

    /**
     * Returns the friendly date without year. Eg: Monday 22 of July
     * 
     * @param  $date
     * @return string
     */
    public static function date($date) 
    {
        return implode(' ', [
            __($date->format('l')),
            $date->format('j'),
            __('of'),
            __($date->format('F')),
        ]);
    }

    /**
     * Returns the friendly date with year. Eg: Monday 22 of July of 2019
     * 
     * @param  $date
     * @return string
     */
    public static function fulldate($date) 
    {
        return implode(' ', [
            static::date($date),
            __('of'),
            __($date->format('Y')),
        ]);
    }

    /**
     * Formats the number as money
     * 
     * @param  $date
     * @return string
     */
    public static function money($amount) 
    {
        return money_format('$%n', $amount);
    }
}