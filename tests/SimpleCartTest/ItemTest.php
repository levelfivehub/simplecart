<?php
namespace SimpleCartTest;

use SimpleCart\Exception\ValidationException;
use SimpleCart\Item;
use SimpleCart\Model\ItemModel;
use InvalidArgumentException;

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

    public function testAddItemWithEmptyReturnsException()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Item to add is either empty or not an array');
        $data = null;
        $this->item->addItem($data);
    }

    public function testAddItemWithNoName()
    {
        $this->setExpectedException(ValidationException::class);

        $data = [
            'name' => '',
            'uniqueId' => '',
            'amount' => '',
            'quantity' => '',
            'currency' => ''
        ];

        $this->item->addItem($data);
    }

}
