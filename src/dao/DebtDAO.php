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