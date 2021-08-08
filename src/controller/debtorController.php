<?php
namespace src\controller;

use Exception;
use src\model\debtor\Debtor;

/**
 * Class debtorController
 * @package src\controller
 */
class debtorController
{
    /** @var array */
    private $aDados;

    /**
     * debtorController constructor.
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
        include_once "src/view/debtor/list.php";
    }
}