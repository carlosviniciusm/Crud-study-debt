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
            'cpfcnpj' => '1234567890',
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
        $oDebtor = $oDebtorDAO->findByCpfCnpj('05868382528');
        $this->assertTrue(!is_null($oDebtor->getId()));
    }

    /**
     * Test delete fake debtor
     */
    public function testDebtorDelete()
    {
        $oDebtorDAO = new DebtorDAO();
        $oDebtor = $oDebtorDAO->findByCpfCnpj('05868382528');

        $this->assertTrue(!is_null($oDebtor->getId()));

        $oDebtor->delete();

        $oDebtor = $oDebtorDAO->findByCpfCnpj('05868382528');
        $this->assertFalse(!is_null($oDebtor->getId()));
    }
}