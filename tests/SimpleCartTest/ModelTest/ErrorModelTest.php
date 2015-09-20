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
            'message' => 'This is an error',
            'secondMessage' => 'This is another error'
        ];

        $error = new ErrorModel();
        $error->setName($staticData['name']);
        $error->addMessage($staticData['message']);

        $this->assertEquals($staticData['name'], $error->getName());
        $this->assertEquals($staticData['message'], current($error->getMessages()));

        $error->addMessage($staticData['secondMessage']);

        $this->assertCount(2, $error->getMessages());
    }

}
