<?php
namespace src\controller;

use Exception;
use src\model\debt\Debt;

/**
 * Class debtController
 * @package src\controller
 */
class debtController
{
    /** @var array */
    private $aDados;

    /**
     * debtController constructor.
     * @param $aDados
     */
    public function __construct($aDados) {
        $this->aDados = $aDados;
    }

    /**
     * Home page
     * @param array $aDados
     * @return void
     * @author Carlos Vinicius cvmm321@gmail.com
     * @since 1.0.0
     */
    public function index(array $aDados): void {
        include_once "src/view/debt/list.php";
    }

    /**
     * Open view to register debt
     */
    public function register()
    {
        include_once "src/view/debt/register.php";
    }

}