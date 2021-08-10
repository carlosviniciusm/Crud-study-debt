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
        $this->bActive = TrueOrFalse::TRUE;
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
     * Update debtor's data in database
     */
    public function update(array $aDadosUpdate): void
    {
        $this->setAttributes($aDadosUpdate);
        (new DebtorDAO())->update($this);
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
     * Create Debtor object from array
     * @param array $aDados
     * @return Debtor
     */
    public static function createFromArray(array $aDados): Debtor
    {
        $oDebtor = new Debtor();

        $oDebtor->setId($aDados['dbr_id']);
        $oDebtor->setName($aDados['dbr_name']);
        $oDebtor->setEmail($aDados['dbr_email']);
        $oDebtor->setZipcode($aDados['dbr_zipcode']);
        $oDebtor->setCpfCnpj($aDados['dbr_cpf_cnpj']);
        $oDebtor->setAddress($aDados['dbr_address']);
        $oDebtor->setNumber($aDados['dbr_number']);
        $oDebtor->setNeighborhood($aDados['dbr_neighborhood']);
        $oDebtor->setCity($aDados['dbr_city']);
        $oDebtor->setState($aDados['dbr_state']);

        $oCreated = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $aDados['dbr_created']);
        $oDebtor->setCreated($oCreated);

        if (!empty($aDados['dbr_birthdate'])) {
            $oBirthdate = DateTimeImmutable::createFromFormat('Y-m-d', $aDados['dbr_birthdate']);
            $oDebtor->setBirthdate($oBirthdate);
        }

        if (!empty($aDados['dbr_phone_number'])) {
            $oDebtor->setPhoneNumber($aDados['dbr_phone_number']);
        }

        if (!empty($aDados['dbr_complement'])) {
            $oDebtor->setComplement($aDados['dbr_complement']);
        }

        if (!empty($aDados['dbr_updated'])) {
            $oUpdated = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $aDados['dbr_updated']);
            $oDebtor->setUpdated($oUpdated);
        }

        return $oDebtor;
    }

    /**
     * Create Debtor objet from request (view)
     * @param array $aDados
     * @return Debtor
     * @throws InvalidAttributeException
     */
    public static function createFromRequest(array $aDados)
    {
        $oDebtor = new Debtor();

        $oDebtor->validate($aDados);

        $oDebtor->setName($aDados['name']);
        $oDebtor->setEmail($aDados['email']);

        $sCpfCnpj = Utils::removeCaracther($aDados['cpf_cnpj']);
        $oDebtor->setCpfCnpj($sCpfCnpj);

        $oBirthdate = DateTimeImmutable::createFromFormat('d/m/Y', $aDados['birthdate']);
        $oDebtor->setBirthdate($oBirthdate);

        $sNumber = Utils::removeCaracther($aDados['phone_number']);
        $oDebtor->setPhoneNumber($sNumber);

        $sZipCode = Utils::removeCaracther($aDados['zipcode']);
        $oDebtor->setZipcode($sZipCode);

        $oDebtor->setAddress($aDados['address']);

        $oDebtor->setNumber($aDados['number']);

        if (!empty($aDados['complement'])) {
            $oDebtor->setComplement($aDados['complement']);
        }

        if (!empty($aDados['neighborhood'])) {
            $oDebtor->setNeighborhood($aDados['neighborhood']);
        }

        if (!empty($aDados['city'])) {
            $oDebtor->setCity($aDados['city']);
        }

        if (!empty($aDados['state'])) {
            $oDebtor->setState($aDados['state']);
        }

        return $oDebtor;
    }

    /**
     * Create array using Debtor object data
     * @return array
     */
    public function toArray(): array
    {
        $aDebtor = [
            $this->getName(),
            $this->getEmail(),
            $this->getCpfCnpj(),
            $this->getBirthdate()->format('Y-m-d'),
            $this->getPhoneNumber(),
            $this->getZipcode(),
            $this->getAddress(),
            $this->getNumber(),
            $this->getComplement(),
            $this->getNeighborhood(),
            $this->getCity(),
            $this->getState(),
            $this->getStatus(),
            $this->isActive(),
            $this->getCreated()->format('Y-m-d H:i:s')
        ];

        if (!is_null($this->getUpdated())) {
            $aDebtor[] = $this->getUpdated()->format('Y-m-d H:i:s');
        }

        return $aDebtor;
    }

    /**
     * Validate filling in the fields
     * @param array $aDados
     * @throws InvalidAttributeException
     */
    public function validate(array $aDados)
    {
        if (empty($aDados['name'])) {
            throw new InvalidAttributeException('Name is empty.');
        }
        if (empty($aDados['email'])) {
            throw new InvalidAttributeException('Email is empty.');
        }
        if (empty($aDados['cpf_cnpj'])) {
            throw new InvalidAttributeException('CPF/CNPJ is empty.');
        }
        if (empty($aDados['birthdate'])) {
            throw new InvalidAttributeException('Birthdate is empty.');
        }
        if (empty($aDados['phone_number'])) {
            throw new InvalidAttributeException('Phone number is empty.');
        }
        if (empty($aDados['zipcode'])) {
            throw new InvalidAttributeException('Zipcode number is empty.');
        }
        if (empty($aDados['address'])) {
            throw new InvalidAttributeException('Address number is empty.');
        }
        if (empty($aDados['number'])) {
            throw new InvalidAttributeException('Number is empty.');
        }
        if (empty($aDados['neighborhood'])) {
            throw new InvalidAttributeException('Neighborhood is empty.');
        }
        if (empty($aDados['city'])) {
            throw new InvalidAttributeException('Neighborhood is empty.');
        }
        if (empty($aDados['state'])) {
            throw new InvalidAttributeException('Neighborhood is empty.');
        }
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

    /**
     * @param DateTimeImmutable $oUpdated
     */
    public function setUpdated(DateTimeImmutable $oUpdated): void
    {
        $this->oUpdated = $oUpdated;
    }

    /**
     * @param array $aDadosUpdate
     */
    public function setAttributes(array $aDadosUpdate): void
    {
        if (!empty($aDadosUpdate['name'])) {
            $this->setName($aDadosUpdate['name']);
        }
        if (!empty($aDadosUpdate['email'])) {
            $this->setEmail($aDadosUpdate['email']);
        }
        if (!empty($aDadosUpdate['cpf_cnpj'])) {
            $this->setCpfCnpj($aDadosUpdate['cpf_cnpj']);
        }
        if (!empty($aDadosUpdate['birthdate'])) {
            $oBirthdate = DateTimeImmutable::createFromFormat('d/m/Y', $aDadosUpdate['birthdate']);
            $this->setBirthdate($oBirthdate);
        }
        if (!empty($aDadosUpdate['phone_number'])) {
            $this->setPhoneNumber($aDadosUpdate['phone_number']);
        }
        if (!empty($aDadosUpdate['zipcode'])) {
            $this->setZipcode($aDadosUpdate['zipcode']);
        }
        if (!empty($aDadosUpdate['address'])) {
            $this->setAddress($aDadosUpdate['address']);
        }
        if (!empty($aDadosUpdate['number'])) {
            $this->setNumber($aDadosUpdate['number']);
        }
        if (!empty($aDadosUpdate['complement'])) {
            $this->setcomplement($aDadosUpdate['complement']);
        }
        if (!empty($aDadosUpdate['neighborhood'])) {
            $this->setNeighborhood($aDadosUpdate['neighborhood']);
        }
        if (!empty($aDadosUpdate['city'])) {
            $this->setCity($aDadosUpdate['city']);
        }
        if (!empty($aDadosUpdate['state'])) {
            $this->setState($aDadosUpdate['state']);
        }

        $this->setUpdated(new DateTimeImmutable('NOW'));
    }
}