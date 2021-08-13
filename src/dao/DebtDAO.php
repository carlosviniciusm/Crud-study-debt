<?php
namespace src\dao;

use DateTimeImmutable;
use Exception;
use framework\system\Connection;
use framework\utils\constants\TrueOrFalse;
use http\Exception\RuntimeException;
use PDO;
use PDOException;
use src\model\debt\Debt;

/**
 * Class DebtDAO
 * @package src\dao
 */
class DebtDAO
{
    /**
     * @param int $iId
     * @return Debt
     */
    public function find(int $iId): Debt
    {
        $sSql = "SELECT * FROM dbt_debt WHERE dbt_id = ?";

        try {
            $stmt = $this->getStatement($sSql);

            $stmt->bindParam(1, $iId);

            $stmt->execute();
            $aDebt = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new RuntimeException("Error when consulting debt.", 500, $e);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!$aDebt) {
            return new Debt();
        }

        return Debt::createFromArray($aDebt);
    }

    /**
     * Save debt data in database
     * @param Debt $oDebt
     */
    public function save(Debt $oDebt): void {
        $sSql = "INSERT INTO dbt_debt(dbr_id, dbt_description, dbt_amount, dbt_due_date, 
                                        dbt_status, dbt_active, dbt_created) VALUES (?,?,?,?,?,?,?)";

        $oDebt->setCreated(new DateTimeImmutable('NOW'));
        $oDebt->setActive(TrueOrFalse::TRUE);

        $aDebt = $oDebt->toArray();

        try {
            $oConnection = Connection::getConnection();
            $oConnection->beginTransaction();

            $stmt = $oConnection->prepare($sSql);
            if (!$stmt) {
                throw new PDOException("Error to prepare query string.");
            }

            $stmt->execute($aDebt);
        } catch (PDOException $e) {
            $oConnection->rollBack();
            throw new PDOException("Error to save debt. " . $e->getMessage());
        }

        $oDebt->setId($oConnection->lastInsertId());
        $oConnection->commit();
    }

    /**
     * Update debt's data in database
     * @param Debt $oDebt
     */
    public function update(Debt $oDebt): void {
        $sSql = "UPDATE dbt_debt 
                    SET dbr_id = ?,
                    dbt_description = ?,
                    dbt_amount = ?,
                    dbt_due_date = ?,
                    dbt_status = ?,
                    dbt_active = ?,
                    dbt_updated = ?
                WHERE dbt_id = ?";

        $aDebt = $oDebt->toArray();
        array_pop($aDebt);
        $aDebt[] = (new DateTimeImmutable('now'))->format('Y-m-d H:i:s');
        $aDebt[] = $oDebt->getId();

        try {
            $oConnection = Connection::getConnection();
            $oConnection->beginTransaction();

            $stmt = $oConnection->prepare($sSql);
            if (!$stmt) {
                throw new PDOException("Error to prepare query string.");
            }

            $stmt->execute($aDebt);
            $oConnection->commit();
        } catch (PDOException $e) {
            $oConnection->rollBack();
            throw new PDOException("Error to update debt. " . $e->getMessage());
        }
    }


    /**
     * @param string $sSql
     * @return \PDOStatement
     */
    public function getStatement(string $sSql): \PDOStatement
    {
        $oConnection = Connection::getConnection();

        $stmt = $oConnection->prepare($sSql);

        if (!$stmt) {
            throw new PDOException();
        }
        return $stmt;
    }
}