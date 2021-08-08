<?php

namespace framework\system;

/**
 * Class Router
 * @package framework\system
 */
class Router
{
    /** @var string $sAction */
    private $sAction;

    private $oEntity;
    /** @var array $aData */
    private $aData;

    /**
     * Configure route
     */
    public function init()
    {
        if (empty($_REQUEST)) {
            $_REQUEST['controller'] = "home";
        }

        $sController = "src\Controller\\" . $_REQUEST['controller'] . "Controller";
        if (class_exists($sController)) {
            $this->oEntity = new $sController($_REQUEST);
            $this->sAction = !empty($_REQUEST['action']) ? $_REQUEST['action'] : "index" ;

            if (method_exists($sController, $this->sAction)) {
                $this->aData['request'] = $_REQUEST;
            }
        }
    }

    /**
     * Route to action of a method
     */
    public function route()
    {
        $sAction = $this->sAction;
        $this->oEntity->$sAction($this->aData);
    }

}