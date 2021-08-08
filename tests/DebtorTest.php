<?php

use framework\exceptions\InvalidAttributeException;
use PHPUnit\Framework\TestCase;
use src\dao\DebtorDAO;
use src\model\debtor\Debtor;

/**
 * Class DebtorTest
 */
class DebtorTest extends TestCase
{
    /**
     * Test save fake debtor
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveGeneral()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm321@gmail.com',
            'cpfcnpj' => '01234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Deputado Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste',
            'neighborhood' => 'Bairro Teste',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $oDebtor = Debtor::createFromRequest($aDados);
        $oDebtor->save();

        $oDebtorDAO = new DebtorDAO();
        $oDebtor = $oDebtorDAO->findByCpfCnpj('01234567890');
        $this->assertTrue(!is_null($oDebtor->getId()));
    }

    /**
     * Test save same CPF/CNPJ
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveSameCpf()
    {
        $aDados = [
            'name' => 'Carlos Teste',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '01234567890',
            'birthdate' => '15/01/1996',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $oDebtor = Debtor::createFromRequest($aDados);
        $this->expectException(PDOException::class);
        $oDebtor->save();
        $oDebtorDAO = new DebtorDAO();
        $oDebtor = $oDebtorDAO->findByCpfCnpj('01234567890');
        $this->assertTrue(!is_null($oDebtor->getId()));
    }

    /**
     * Test delete fake debtor
     */
    public function testDebtorDelete()
    {
        $oDebtorDAO = new DebtorDAO();
        $oDebtor = $oDebtorDAO->findByCpfCnpj('01234567890');

        $this->assertTrue(!is_null($oDebtor->getId()));

        $oDebtor->delete();

        $oDebtor = $oDebtorDAO->findByCpfCnpj('01234567890');
        $this->assertFalse(!is_null($oDebtor->getId()));
    }

    /**
     * Test save name empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveNameEmpty()
    {
        $aDados = [
            'name' => '',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '15/01/1996',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save email empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveEmailEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => '',
            'cpfcnpj' => '1234567890',
            'birthdate' => '15/01/1996',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save cpf/cnpj empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveCpfCnpjEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '',
            'birthdate' => '15/01/1996',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save birthdate empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveBirthdateEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save phone number empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSavePhoneNumberEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save zipcode empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveZipcodeEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save address empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveAddressEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => '',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save number empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveNumberEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save neighborhood empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveNeighborhoodEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Complemento Teste',
            'neighborhood' => '',
            'city' => 'Aracaju',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save city empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveCityEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => '',
            'state' => 'SE'
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }

    /**
     * Test save state empty
     * @throws InvalidAttributeException
     */
    public function testDebtorSaveStateEmpty()
    {
        $aDados = [
            'name' => 'Carlos Vinicius',
            'email' => 'cvmm121@gmail.com',
            'cpfcnpj' => '1234567890',
            'birthdate' => '12/01/1994',
            'phone_number' => '(79) 9 9999-9999',
            'zipcode' => '99999-999',
            'address' => 'Rua Teste',
            'number' => '25',
            'complement' => 'Conjunto Teste 2',
            'neighborhood' => 'Bairro Teste 2',
            'city' => 'Aracaju',
            'state' => ''
        ];

        $this->expectException(InvalidAttributeException::class);
        $oDebtor = Debtor::createFromRequest($aDados);
    }
}