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

    /**
     * Save debtor data in database
     * @param Debtor $oDebtor
     */
    public function save(Debtor $oDebtor): void {
        $sSql = "INSERT INTO dbr_debtor(dbr_name, dbr_email, dbr_cpf_cnpj, dbr_birthdate, dbr_phone_number, dbr_zipcode,
                       dbr_address, dbr_number, dbr_complement, dbr_neighborhood, dbr_city, dbr_state, dbr_status,
                       dbr_active, dbr_created)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

        $oDebtor->setCreated(new DateTimeImmutable('NOW'));
        $oDebtor->setActive(TrueOrFalse::TRUE);

        $aDebtor = $oDebtor->toArray();

        try {
            $oConnection = Connection::getConnection();
            $oConnection->beginTransaction();

            $stmt = $oConnection->prepare($sSql);
            if (!$stmt) {
                throw new PDOException("Error to prepare query string.");
            }

            $stmt->execute($aDebtor);
            $oConnection->commit();
        } catch (\PDOException $e) {
            $oConnection->rollBack();
            throw new PDOException("Error to save debtor.");
        }

        $oDebtor->setId($oConnection->lastInsertId());
    }

    /**
     * Delete debtor registry from database
     * @param Debtor $oDebtor
     * @return false
     */
    public function delete(Debtor $oDebtor): void {
        $sSql = "DELETE FROM dbr_debtor WHERE dbr_id = ?";

        try {
            $oConnection = Connection::getConnection();
            $oConnection->beginTransaction();

            $stmt = $oConnection->prepare($sSql);
            if (!$stmt) {
                return false;
            }

            $stmt->execute([$oDebtor->getId()]);

            $oConnection->commit();
        } catch (PDOException $e) {
            $oConnection->rollBack();
            throw new PDOException("Error deleting debtor.");
        }
    }
}