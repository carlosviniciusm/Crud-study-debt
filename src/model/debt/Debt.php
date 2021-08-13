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
     * Create object based on request data
     * @param array $aDados
     * @return Debt
     * @throws InvalidAttributeException
     */
    public static function createFromRequest(array $aDados): Debt
    {
        $oDebt = new Debt();

        $oDebt->validate($aDados);

        $oDebt->setDebtorId($aDados['debtor_id']);
        $oDebt->setDescription($aDados['description']);

        $oDebt->setAmount(floatval($aDados['amount']));

        $oDueDate = DateTimeImmutable::createFromFormat('d/m/Y', $aDados['due_date']);
        $oDebt->setDueDate($oDueDate);

        $oDebt->setCreated((new DateTimeImmutable('NOW')));
        $oDebt->setStatus(PaidUnpaid::UNPAID);
        $oDebt->setActive(TrueOrFalse::TRUE);

        return $oDebt;
    }

    /**
     * Save debt registry
     */
    public function save()
    {
        $oDebtorDAO = new DebtDAO();
        $oDebtorDAO->save($this);
    }


    /**
     * Update debt's data in database
     */
    public function update(array $aDadosUpdate): void
    {
        $this->setAttributes($aDadosUpdate);
        (new DebtDAO())->update($this);
    }

    /**
     * Set attributes in Debt's object
     * @param array $aDados
     */
    public function setAttributes(array $aDados)
    {
        if (!empty($aDados['description'])) {
            $this->setDescription($aDados['description']);
        }
        if (!empty($aDados['amount'])) {
            $this->setAmount($aDados['amount']);
        }
        if (!empty($aDados['due_date'])) {
            $oDueDate = DateTimeImmutable::createFromFormat('d/m/Y', $aDados['due_date']);
            $this->setDueDate($oDueDate);
        }
        if (!is_null($aDados['status'])) {
            $this->setStatus($aDados['status']);
        }
        if (!empty($aDados['active'])) {
            $this->setActive($aDados['active']);
        }
    }



    /**
     * Create array using data from debt object
     * @return array
     */
    public function toArray()
    {
        $aDebt = [
            $this->getDebtorId(),
            $this->getDescription(),
            $this->getAmount(),
            $this->getDueDate()->format('Y-m-d'),
            $this->getStatus(),
            $this->getActive(),
            $this->getCreated()->format('Y-m-d H:i:s')
        ];

        if (!is_null($this->getUpdated())) {
            $aDebt[] = $this->getUpdated()->format('Y-m-d H:i:s');
        }

        return $aDebt;
    }

    /**
     * Validate data from request
     * @param array $aDados
     * @throws InvalidAttributeException
     */
    private function validate(array $aDados)
    {
        if (is_null($aDados['debtor_id'])) {
            throw new InvalidAttributeException('Name is empty.');
        }

        if (empty($aDados['description'])) {
            throw new InvalidAttributeException('Name is empty.');
        }

        if (is_null($aDados['amount'])) {
            throw new InvalidAttributeException('Name is empty.');
        }

        if (empty($aDados['due_date'])) {
            throw new InvalidAttributeException('Name is empty.');
        }
    }

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