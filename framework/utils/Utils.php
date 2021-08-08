<?php
namespace framework\utils;

/**
 * Class Utils
 * @package framework\utils
 */
class Utils
{
    /**
     * Remove caracther of a string
     * @param string $sValue
     * @return string
     */
    public static function removeCaracther(string $sValue): string
    {
        return preg_replace("/[^0-9]/", "", $sValue);
    }
    
}