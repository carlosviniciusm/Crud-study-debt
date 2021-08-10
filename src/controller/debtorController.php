<?php
namespace src\controller;

use Exception;
use framework\exceptions\InvalidAttributeException;
use src\dao\DebtorDAO;
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
    public function list(array $aDados): void {
        include_once "src/view/debtor/list.php";
    }

    /**
     * Save debtor registry
     * @param array $aDados
     */
    public function save(array $aDados): void
    {
        try {
            $oDebtor = Debtor::createFromRequest($aDados);
            $oDebtor->save();
        } catch (Exception $e) {
            echo 'Erro ao salvar';
        }
    }

    /**
     * Update debtor registry
     * @param array $aDados
     */
    public function update(array $aDados): void
    {
        try {
            if (empty($aDados['id'])) {
                throw new InvalidAttributeException('Debtor\'s id is empty.');
            }

            $oDebtor = (new DebtorDAO())->find($aDados['id']);
            $oDebtor->update($aDados);
        } catch (Exception $e) {
            echo 'Erro ao salvar.'.$e->getMessage();
        }
    }

    /**
     * Open view to register debtor
     */
    public function register()
    {
        include_once "src/view/debtor/register.php";
    }

}