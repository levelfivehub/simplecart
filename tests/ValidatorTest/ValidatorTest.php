<?php
namespace SimpleCartTest\ValidatorTest;

use PHPUnit_Framework_TestCase;
use SimpleCart\Model\ErrorModel;
use SimpleCart\Validator\Validator;

class ValidatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Validator
     */
    private $validator;

    public function setUp()
    {
        $this->validator = new Validator();
    }

    public function testValidatorAddErrors()
    {
        $this->assertFalse($this->validator->hasErrors());

        $addError = $this->validator->addError('Field', 'Error Message');
        $this->assertTrue($addError);

        $this->assertEquals(1, $this->validator->getErrorCount());
        $this->assertTrue($this->validator->hasErrors());

        $addError = $this->validator->addError('Field 2', 'Error Message');
        $this->assertTrue($addError);

        $this->assertEquals(2, $this->validator->getErrorCount());
        $this->assertTrue($this->validator->hasErrors());

        /** @var ErrorModel $error */
        foreach ($this->validator->getErrors() as $error) {
            $this->assertInstanceOf(ErrorModel::class, $error);
            $this->assertEquals('Error Message', $error->getMessage());
        }
    }

}
