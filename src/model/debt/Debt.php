<?php
namespace src\model\debt;

use DateTimeImmutable;
use framework\exceptions\InvalidAttributeException;
use framework\utils\constants\PaidUnpaid;
use framework\utils\constants\TrueOrFalse;
use src\dao\DebtDAO;

/**
 * Class Debt
 * @package src\model\debt
 */
class Debt
{
    /** @var int $iId */
    private $iId;
    /** @var int $iDebtorId */
    private $iDebtorId;
    /** @var string $sDescription */
    private $sDescription;
    /** @var float $oAmount */
    private $oAmount;
    /** @var DateTimeImmutable $oDueDate */
    private $oDueDate;
    /** @var int $iStatus */
    private $iStatus;
    /** @var int $iActive */
    private $iActive;
    /** @var DateTimeImmutable $oCreated */
    private $oCreated;
    /** @var DateTimeImmutable $oUpdated */
    private $oUpdated;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->iId;
    }

    /**
     * @param int $iId
     */
    public function setId(int $iId): void
    {
        $this->iId = $iId;
    }

    /**
     * @return int
     */
    public function getDebtorId(): int
    {
        return $this->iDebtorId;
    }

    /**
     * @param int $iDebtorId
     */
    public function setDebtorId(int $iDebtorId): void
    {
        $this->iDebtorId = $iDebtorId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->sDescription;
    }

    /**
     * @param string $sDescription
     */
    public function setDescription(string $sDescription): void
    {
        $this->sDescription = $sDescription;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->oAmount;
    }

    /**
     * @param float $oAmount
     */
    public function setAmount(float $oAmount): void
    {
        $this->oAmount = $oAmount;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDueDate(): DateTimeImmutable
    {
        return $this->oDueDate;
    }

    /**
     * @param DateTimeImmutable $oDueDate
     */
    public function setDueDate(DateTimeImmutable $oDueDate): void
    {
        $this->oDueDate = $oDueDate;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->iStatus;
    }

    /**
     * @param int $iStatus
     */
    public function setStatus(int $iStatus): void
    {
        $this->iStatus = $iStatus;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->iActive;
    }

    /**
     * @param int $iActive
     */
    public function setActive(int $iActive): void
    {
        $this->iActive = $iActive;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreated(): DateTimeImmutable
    {
        return $this->oCreated;
    }

    /**
     * @param DateTimeImmutable $oCreated
     */
    public function setCreated(DateTimeImmutable $oCreated): void
    {
        $this->oCreated = $oCreated;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdated(): ?DateTimeImmutable
    {
        return $this->oUpdated;
    }

    /**
     * @param DateTimeImmutable $oUpdated
     */
    public function setUpdated(DateTimeImmutable $oUpdated): void
    {
        $this->oUpdated = $oUpdated;
    }
}