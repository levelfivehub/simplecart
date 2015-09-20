<?php
namespace SimpleCartTest;

use SimpleCart\Exception\ValidationException;
use SimpleCart\Item;
use SimpleCart\Model\ItemModel;
use InvalidArgumentException;
use SimpleCart\Exception\InvalidFieldException;

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

    public function testAddItemWithEmptyReturnsException()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Item to add is either empty or not an array');
        $data = null;
        $this->item->getItemModel($data);
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

        $this->item->getItemModel($data);
    }

    public function testAddItemAsArrayIsTrue()
    {
        $itemContext = [
            'name' => 'Test',
            'uniqueId' => '123',
            'amount' => 10.99,
            'quantity' => '1',
            'currency' => 'GBP'
        ];

        /** @var ItemModel $item */
        $item = $this->item->getItemModel($itemContext);

        $this->assertInstanceOf(ItemModel::class, $item);
        $this->assertEquals($itemContext['name'], $item->getName());
        $this->assertEquals($itemContext['uniqueId'], $item->getUniqueId());
        $this->assertEquals($itemContext['amount'], $item->getAmount());
        $this->assertEquals($itemContext['quantity'], $item->getQuantity());
        $this->assertEquals($itemContext['currency'], $item->getCurrency());
    }

    public function testGetItemByInvalidUniqueId()
    {
        $this->setExpectedException(InvalidFieldException::class);
        $this->item->getItemByUniqueId('abcdef', $this->dummyCart());
    }

    public function testGetItemByUniqueId()
    {
        $item = $this->item->getItemByUniqueId('12345', $this->dummyCart());

        $this->assertInstanceOf(ItemModel::class, $item);
        $this->assertEquals($item->getName(), 'Test3');
        $this->assertEquals($item->getUniqueId(), '12345');
        $this->assertEquals($item->getAmount(), 10.99);
        $this->assertEquals($item->getQuantity(), 1);
        $this->assertEquals($item->getCurrency(), 'GBP');
    }

    private function dummyCart()
    {
        $itemContext = [
            'name' => 'Test',
            'uniqueId' => '123',
            'amount' => 10.99,
            'quantity' => '1',
            'currency' => 'GBP'
        ];

        /** @var ItemModel $itemOne */
        $itemOne = $this->item->getItemModel($itemContext);

        $itemContext = [
            'name' => 'Test2',
            'uniqueId' => '1234',
            'amount' => 10.99,
            'quantity' => '1',
            'currency' => 'GBP'
        ];

        /** @var ItemModel $itemTwo */
        $itemTwo = $this->item->getItemModel($itemContext);

        $itemContext = [
            'name' => 'Test3',
            'uniqueId' => '12345',
            'amount' => 10.99,
            'quantity' => '1',
            'currency' => 'GBP'
        ];

        /** @var ItemModel $itemThree */
        $itemThree = $this->item->getItemModel($itemContext);

        return [
            $itemOne, $itemTwo, $itemThree
        ];
    }

}
