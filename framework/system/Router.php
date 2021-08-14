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
        if (empty($_REQUEST['controller'])) {
            $_REQUEST['controller'] = "home";
        }

        $sController = "src\controller\\" . $_REQUEST['controller'] . "Controller";
        var_dump('Controller:',$sController);
        if (class_exists($sController)) {
            var_dump('Classe existe!');
            $this->oEntity = new $sController($_REQUEST);
            $this->sAction = !empty($_REQUEST['action']) ? $_REQUEST['action'] : "list" ;

            if (method_exists($sController, $this->sAction)) {
                var_dump('Método existe!');
                $this->aData = $_REQUEST;
            }
        }

        if (is_null($this->sAction)) {
            $this->sAction = 'list';
        }

        var_dump('Entity: ', $this->oEntity);
        $sAction = $this->sAction;
        $this->oEntity->$sAction($this->aData);
    }

}