<?php
namespace SimpleCartTest;

use PHPUnit_Framework_TestCase;
use SimpleCart\Exception\ValidationException;

class ValidationExceptionTest extends PHPUnit_Framework_TestCase {

    /** @var ValidationException */
    private $exception;

    public function setUp()
    {
        $this->exception = new ValidationException();
    }

    public function testSetErrorsWillReturnErrors()
    {
        $this->exception->setErrors([ 'test', 'test2' ]);

        $this->assertCount(2, $this->exception->getErrors());
        $this->assertEquals(ValidationException::ERROR_MESSAGE, $this->exception->getMessage());
    }

}
