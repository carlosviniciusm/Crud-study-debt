<?php

require_once "vendor/autoload.php";

if (!empty($_REQUEST)) {
    $sController = "receiveit\Controller\\" . $_REQUEST['controller'] . "Controller";
    if (class_exists($sController)) {
        $oEntity = new $sController($_REQUEST);
        $sAction = $_REQUEST['action'];

        if (empty($sAction)) {
            $sAction = "index";
        }

        $aData = [];
        if (method_exists($sController, $sAction)) {
            $aData['request'] = $_REQUEST;
            $oEntity->$sAction($aData);
        }
    }
} else {
    include_once "home.php";
}