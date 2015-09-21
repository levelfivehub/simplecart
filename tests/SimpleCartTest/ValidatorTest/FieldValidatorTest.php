<?php
namespace SimpleCartTest\ValidatorTest;

use PHPUnit_Framework_TestCase;
use SimpleCart\Validator\FieldValidator;
use SimpleCart\Exception\InvalidFieldException;
use SimpleCart\Validator\Validator;

class FieldValidatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var FieldValidator
     */
    private $validator;

    public function setUp()
    {
        $this->validator = new FieldValidator();
    }

    public function testFieldValidatorReturnsError()
    {
        $this->setExpectedException(InvalidFieldException::class);

        $fields = [];
        $this->validator->setExpectedFields($fields);
        $this->validator->setData([ 'test' ]);
        $this->validator->validateFields();
    }

    public function testFieldNotSpecifiedReturnsError()
    {
        $this->setExpectedException(InvalidFieldException::class);

        $fields = [
            'name',
            'address',
            'country'
        ];

        $this->validator->setExpectedFields($fields);
        $this->validator->setData([ 'test' => 'test' ]);
        $this->validator->validateFields();
    }

    public function testFieldValidationReturnsTrue()
    {
        $fields = [
            'name',
            'address',
            'country'
        ];

        $this->validator->setExpectedFields($fields);

        $data = [
            'name' => 'Gaurav',
            'address' => 'Somewhere',
            'country' => 'UK'
        ];

        $this->validator->setData($data);

        $validate = $this->validator->validateFields();

        $this->assertTrue($validate);
    }

}
