<?php
namespace src\dao;

use DateTimeImmutable;
use Exception;
use framework\system\Connection;
use framework\utils\constants\TrueOrFalse;
use PDO;
use src\model\debtor\Debtor;
use http\Exception\RuntimeException;
use PDOException;

/**
 * Class DebtorDAO
 * @package src\dao
 */
class DebtorDAO
{

    /**
     * Find debtor using cpf or cnpj
     * @param string $sCpfCnpj
     * @return Debtor
     */
    public function findByCpfCnpj(string $sCpfCnpj): Debtor
    {
        $sSql = "SELECT * FROM dbr_debtor WHERE dbr_cpf_cnpj = ?";

        try {
            $oConnection = Connection::getConnection();

            $stmt = $oConnection->prepare($sSql);

            if (!$stmt) {
                throw new PDOException();
            }

            $stmt->bindParam(1, $sCpfCnpj);

            $stmt->execute();
            $aDebtor = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new RuntimeException("Error when consulting debtor.", 500, $e);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!$aDebtor) {
            return new Debtor();
        }

        return Debtor::createFromArray($aDebtor);
    }

}