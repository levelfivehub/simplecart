<?php
namespace SimpleCartTest;

use SimpleCart\Item;
use SimpleCart\Model\ItemModel;
use SimpleCart\Exception\InvalidItemException;

class ItemTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Item
     */
    private $item;

    public function setUp()
    {
        $this->item = new Item('PHPUnit');
    }

    public function testGenerateModel()
    {
        $itemContext = [
            'uniqueId' => '1',
            'name' => 'Balloon',
            'price' => '10.88',
            'quantity' => 2,
            'currency' => 'GBP'
        ];

        $generateModel = $this->item->generateModel(
            $itemContext['uniqueId'],
            $itemContext['name'],
            $itemContext['price'],
            $itemContext['quantity'],
            $itemContext['currency']
        );

        $this->assertInstanceOf(ItemModel::class, $generateModel);
        $this->assertEquals($itemContext['name'], $generateModel->getName());
        $this->assertEquals($itemContext['uniqueId'], $generateModel->getUniqueId());
        $this->assertEquals($itemContext['price'], $generateModel->getAmount());
        $this->assertEquals($itemContext['quantity'], $generateModel->getQuantity());
        $this->assertEquals($itemContext['currency'], $generateModel->getCurrency());
    }

    public function testAddItemWithNoName()
    {
        $this->markTestIncomplete('Working on Validator');

        $this->setExpectedException(InvalidItemException::class, 'Item Name not specified');
        //$this->item->addItem();
    }

}
