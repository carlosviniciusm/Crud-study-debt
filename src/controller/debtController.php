<?php
namespace src\controller;

use Exception;
use src\dao\DebtDAO;
use src\dao\DebtorDAO;
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
    public function list(array $aDados): void {
        $loDebt = DebtDAO::findAllActive();

        include_once "src/view/debt/list.php";
    }

    /**
     * Save debt registry
     * @param array $aDados
     */
    public function save(array $aDados): void
    {
        try {
            $oDebt = Debt::createFromRequest($aDados);
            $oDebt->save();
            $aReturn = ['msg' => 'O cadastro da dívida foi realizado com sucesso!', 'status' => true];
        } catch (Exception $e) {
            $aReturn = ['msg' => 'Erro ao salvar a dívida: '.$e->getMessage(), 'status' => false];
        }

        echo json_encode($aReturn);
    }

    /**
     * Open view to register debt
     */
    public function register()
    {
        $loDebtor = DebtorDAO::findDebtorAjax();

        include_once "src/view/debt/register.php";
    }

    /**
     * Inactivate debt
     * @param array $aDados
     */
    public function delete(array $aDados)
    {
        $aReturn = ['status' => true];
        try {
            $oDebt = (new DebtDAO())->find($aDados['id']);
            $oDebt->inactivate();
        } catch (Exception $e) {
            $aReturn = ['status' => false];
        }

        echo json_encode($aReturn);
    }

}