<?php
namespace framework\system;

use PDO;
use PDOException;

/**
 * Class Connection
 * @package framework\system
 */
class Connection extends PDO
{
    /** @var PDO $oPdo */
    private static $oPdo;

    /**
     * Use singleton to return connection
     * @return PDO
     */
    public static function getConnection()
    {
        if (is_null(self::$oPdo)) {
            return self::create();
        }

        return self::$oPdo;
    }

    /**
     * Create connection with mysql using PDO
     * @return PDO
     */
    protected static function create(): PDO
    {
        $sDrive = 'mysql:host=localhost;dbname=receiveit';
        $sUser = 'root';
        $sPass = 'root';
        $aPDO = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try {
            self::$oPdo = new PDO($sDrive, $sUser, $sPass, $aPDO);
            if (!self::$oPdo) {
                die('Error to start connection.');
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
        return self::$oPdo;
    }

}