<?php
namespace SimpleCartTest;

use PHPUnit_Framework_TestCase;
use SimpleCart\Model\ItemModel;

class ItemModelTest extends PHPUnit_Framework_TestCase {

    private $itemModel;

    public function setUp()
    {
        $this->itemModel = new ItemModel();
    }

    public function testItemModel()
    {
        $staticData = [
            'uniqueId' => '1',
            'name' => 'Baloon',
            'amount' => '10.99',
            'currency' => 'GBP',
            'quantity' => '1',
        ];

        $item = new ItemModel();
        $item->setUniqueId($staticData['uniqueId']);
        $item->setName($staticData['name']);
        $item->setAmount($staticData['amount']);
        $item->setCurrency($staticData['currency']);
        $item->setQuantity($staticData['quantity']);

        $this->assertEquals($staticData['uniqueId'], $item->getUniqueId());
        $this->assertEquals($staticData['name'], $item->getName());
        $this->assertEquals($staticData['amount'], $item->getAmount());
        $this->assertEquals($staticData['currency'], $item->getCurrency());
        $this->assertEquals($staticData['quantity'], $item->getQuantity());
    }

}
