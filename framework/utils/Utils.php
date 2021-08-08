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

    /**
     * Import javascripts files dynamically
     * @param string $sFile
     * @param string $sModule
     */
    public static function importJs(string $sFile, string $sModule = ''): void
    {
        $sModule = !empty($sModule) ? $sModule : 'general';
        echo '../public/js/'.$sModule.'/'.$sFile.'.js';
    }

    /**
     * Import css files dynamically
     * @param string $sFile
     * @param string $sModule
     */
    public static function importCss(string $sFile, string $sModule = ''): void
    {
        $sModule = !empty($sModule) ? $sModule : 'general';
        echo '../public/css/'.$sModule.'/'.$sFile.'.css';
    }
    
}