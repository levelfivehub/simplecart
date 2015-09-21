<?php
namespace SimpleCartTest\ValidatorTest;

use PHPUnit_Framework_TestCase;
use SimpleCart\Exception\ValidationException;
use SimpleCart\Validator\ItemValidator;

class ItemValidatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ItemValidator
     */
    private $validator;

    public function setUp()
    {
        $this->validator = new ItemValidator();
    }

    public function testIncorrectNameReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => '',
            'amount' => '10.99',
            'quantity' => 2,
            'uniqueId' => '1',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testInvalidNameReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => [],
            'amount' => '10.99',
            'quantity' => 2,
            'uniqueId' => '1',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testIncorrectAmountReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => 'Balloon',
            'amount' => '',
            'quantity' => 2,
            'uniqueId' => '1',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testInvalidAmountReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => 'Balloon',
            'amount' => 'test',
            'quantity' => 2,
            'uniqueId' => '1',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testIncorrectQuantityReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => 'Balloon',
            'amount' => '',
            'quantity' => '',
            'uniqueId' => '1',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testInvalidQuantityReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => 'Balloon',
            'amount' => 'test',
            'quantity' => 'test',
            'uniqueId' => '1',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testIncorrectUniqueIdReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => 'Balloon',
            'amount' => '',
            'quantity' => 2,
            'uniqueId' => [],
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testInvalidUniqueIdReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => 'Balloon',
            'amount' => 'test',
            'quantity' => 2,
            'uniqueId' => '',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testInvalidCurrencyReturnsErrors()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => 'Balloon',
            'amount' => 'test',
            'quantity' => 2,
            'uniqueId' => '',
            'currency' => []
        ];

        $this->validator->setData($data);
        $this->validator->validate();
    }

    public function testItemAddedIsValid()
    {
        $data = [
            'name' => 'Balloon',
            'amount' => 10.99,
            'quantity' => 2,
            'uniqueId' => '1',
            'currency' => 'GBP'
        ];

        $this->validator->setData($data);
        $validate = $this->validator->validate();

        $this->assertTrue($validate);

        // Now let's check without the currency (optional field)
        $data = [
            'name' => 'Balloon',
            'amount' => 12.95,
            'quantity' => 2,
            'uniqueId' => '1'
        ];

        $this->validator->setData($data);
        $validate = $this->validator->validate();

        $this->assertTrue($validate);
    }

}
