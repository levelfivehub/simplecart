<?php
namespace SimpleCartTest;

use PHPUnit_Framework_TestCase;
use SimpleCart\Model\ErrorModel;

class ErrorModelTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ErrorModel
     */
    private $errorModel;

    public function setUp()
    {
        $this->errorModel = new ErrorModel();
    }

    public function testErrorModel()
    {
        $staticData = [
            'name' => 'Firstname',
            'message' => 'This is an error'
        ];

        $error = new ErrorModel();
        $error->setName($staticData['name']);
        $error->setMessage($staticData['message']);

        $this->assertEquals($staticData['name'], $error->getName());
        $this->assertEquals($staticData['message'], $error->getMessage());
    }

}
