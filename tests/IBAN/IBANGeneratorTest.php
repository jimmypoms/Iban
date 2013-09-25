<?php

use IBAN\Rule\DE\IBANRuleDE000100;
class IBANGeneratorTest extends PHPUnit_Framework_TestCase
{
    protected $ibanGenerator;
    protected $generatorTestData;
    
    protected function setUp() {
        $this->ibanGenerator = new \IBAN\Generation\IBANGenerator();
        $this->generatorTestData = file('tests/fixtures/test_data.txt');
    }

    protected function tearDown() {
        $this->ibanGenerator = null;
        $this->generatorTestData = null;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGenerate_throwsInvalidArgumentExceptionOnMissingLocaleCode() {
        $this->ibanGenerator->generate('', '', '');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGenerate_throwsInvalidArgumentExceptionOnMissingInstituteIdentification() {
        $this->ibanGenerator->generate('DE', '', '');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGenerate_throwsInvalidArgumentExceptionOnMissingBankAccountNumber() {
        $this->ibanGenerator->generate('DE', '50010517', '');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGenerate_throwsInvalidArgumentExceptionOnWrongLocaleCode() {
        $this->ibanGenerator->generate('FF', '10000000', '1000000000');
    }
    
    public function testGenerate_ValidIban() {
        foreach ($this->generatorTestData as $testData) {
            $testDataArray = explode(';', $testData);
            $generatedIban = $this->ibanGenerator->generate(trim($testDataArray[0]), trim($testDataArray[1]), trim($testDataArray[2]));
            $this->assertEquals(trim($testDataArray[3]), trim($generatedIban));
        }
    }
    
    /**
     * @expectedException Exception
     */
    public function testCreateIbanRuleDE000100ShouldThrowException() {
        $rule = new IBANRuleDE000100('', '', '');
    }
    
    public function testGenerate_IbanForRuleDE000200() {
        $generatedIban = $this->ibanGenerator->generate('DE', '72020700', '1000000860');
        $this->assertEquals('', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '72020700', '1000000600');
        $this->assertEquals('', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '72020700', '12345678');
        $this->assertEquals('DE05720207000012345678', trim($generatedIban));
    }
    
    public function testGenerate_IbanForRuleDE000300() {
    	$generatedIban = $this->ibanGenerator->generate('DE', '51010400', '6161604670');
    	$this->assertEquals('', trim($generatedIban));
    	$generatedIban = $this->ibanGenerator->generate('DE', '51010400', '12345678');
    	$this->assertEquals('DE94510104000012345678', trim($generatedIban));
    }
    
    public function testGenerate_IbanForRuleDE000400() {
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '135');
        $this->assertEquals('DE86100500000990021440', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '1111');
        $this->assertEquals('DE19100500006600012020', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '1900');
        $this->assertEquals('DE73100500000920019005', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '7878');
        $this->assertEquals('DE48100500000780008006', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '8888');
        $this->assertEquals('DE43100500000250030942', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '9595');
        $this->assertEquals('DE60100500001653524703', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '97097');
        $this->assertEquals('DE15100500000013044150', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '112233');
        $this->assertEquals('DE54100500000630025819', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '336666');
        $this->assertEquals('DE22100500006604058903', trim($generatedIban));
        $generatedIban = $this->ibanGenerator->generate('DE', '10050000', '484848');
        $this->assertEquals('DE43100500000920018963', trim($generatedIban));
    }
}
