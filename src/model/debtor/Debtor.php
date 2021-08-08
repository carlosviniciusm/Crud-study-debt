<?php
namespace src\model\debtor;

use DateTimeImmutable;
use framework\exceptions\InvalidAttributeException;
use framework\utils\constants\CreditorDebtor;
use framework\utils\constants\TrueOrFalse;
use framework\utils\Utils;
use src\dao\DebtorDAO;

/**
 * Class Debtor
 * @package src\model\debtor
 */
class Debtor
{
    /** @var int $iId */
    private $iId;
    /** @var string $sName */
    private $sName;
    /** @var string $sEmail */
    private $sEmail;
    /** @var string $sCpfCnpj */
    private $sCpfCnpj;
    /** @var DateTimeImmutable $oBirthdate */
    private $oBirthdate;
    /** @var string $sPhoneNumber */
    private $sPhoneNumber;
    /** @var string $sZipcode */
    private $sZipcode;
    /** @var string $sAddress */
    private $sAddress;
    /** @var string $sNumber */
    private $sNumber;
    /** @var string $sComplement */
    private $sComplement;
    /** @var string $sNeighborhood */
    private $sNeighborhood;
    /** @var string $sCity */
    private $sCity;
    /** @var string $sState */
    private $sState;
    /** @var int $iStatus */
    private $iStatus;
    /** @var bool $bActive */
    private $bActive;
    /** @var DateTimeImmutable $oCreated */
    private $oCreated;
    /** @var DateTimeImmutable $oUpdated */
    private $oUpdated;

    /**
     * Debtor constructor.
     */
    public function __construct()
    {
        $this->iStatus = CreditorDebtor::DEBTOR;
        $this->isActive = TrueOrFalse::TRUE;
    }

    /**
     * Register debtor's data in database
     */
    public function save(): void
    {
        $oDebtorDAO = new DebtorDAO();
        $oDebtorDAO->save($this);
    }

    /**
     * Delete debtor's data from database
     */
    public function delete(): void
    {
        $oDebtorDAO = new DebtorDAO();
        $oDebtorDAO->delete($this);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->bActive;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->iId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->sName ?? "";
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->sEmail;
    }

    /**
     * @return string
     */
    public function getCpfCnpj()
    {
        return $this->sCpfCnpj;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBirthdate()
    {
        return $this->oBirthdate;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->sPhoneNumber;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->sZipcode;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->sAddress;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->sNumber;
    }

    /**
     * @return string
     */
    public function getComplement()
    {
        return $this->sComplement;
    }

    /**
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->sNeighborhood;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->sCity;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->sState;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->iStatus;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreated()
    {
        return $this->oCreated;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdated()
    {
        return $this->oUpdated;
    }

    /**
     * @param int $iId
     */
    public function setId(int $iId): void
    {
        $this->iId = $iId;
    }

    /**
     * @param string $sName
     */
    public function setName(string $sName): void
    {
        $this->sName = $sName;
    }

    /**
     * @param string $sEmail
     */
    public function setEmail(string $sEmail): void
    {
        $this->sEmail = $sEmail;
    }

    /**
     * @param string $sCpfCnpj
     */
    public function setCpfCnpj(string $sCpfCnpj): void
    {
        $this->sCpfCnpj = $sCpfCnpj;
    }

    /**
     * @param \DateTimeImmutable $oBirthdate
     */
    public function setBirthdate(\DateTimeImmutable $oBirthdate): void
    {
        $this->oBirthdate = $oBirthdate;
    }

    /**
     * @param string $sPhoneNumber
     */
    public function setPhoneNumber(string $sPhoneNumber): void
    {
        $this->sPhoneNumber = $sPhoneNumber;
    }

    /**
     * @param string $sZipcode
     */
    public function setZipcode(string $sZipcode): void
    {
        $this->sZipcode = $sZipcode;
    }

    /**
     * @param string $sAddress
     */
    public function setAddress(string $sAddress): void
    {
        $this->sAddress = $sAddress;
    }

    /**
     * @param string $sNumber
     */
    public function setNumber(string $sNumber): void
    {
        $this->sNumber = $sNumber;
    }

    /**
     * @param string $sComplement
     */
    public function setComplement(string $sComplement): void
    {
        $this->sComplement = $sComplement;
    }

    /**
     * @param string $sNeighborhood
     */
    public function setNeighborhood(string $sNeighborhood): void
    {
        $this->sNeighborhood = $sNeighborhood;
    }

    /**
     * @param string $sCity
     */
    public function setCity(string $sCity): void
    {
        $this->sCity = $sCity;
    }

    /**
     * @param string $sState
     */
    public function setState(string $sState): void
    {
        $this->sState = $sState;
    }

    /**
     * @param bool $bActive
     */
    public function setActive(bool $bActive): void
    {
        $this->bActive = $bActive;
    }

    /**
     * @param \DateTimeImmutable $oCreated
     */
    public function setCreated(\DateTimeImmutable $oCreated): void
    {
        $this->oCreated = $oCreated;
    }
}