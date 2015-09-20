<?php
namespace SimpleCartTest;

use SimpleCart\SimpleCart;
use Zend\Session\Container;

class SimpleCartTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var SimpleCart
     */
    private $simpleCart;

    public function setUp()
    {
        $this->simpleCart = new SimpleCart('phpunit');
        $this->simpleCart->clearCart();
    }

    public function testAddItemToCart()
    {
        $this->simpleCart->clearCart();

        $itemContext = [
            'name' => 'Test',
            'uniqueId' => '123',
            'amount' => 10.99,
            'quantity' => '1',
            'currency' => 'GBP'
        ];

        $addItem = $this->simpleCart->addItem($itemContext);

        $this->assertTrue($addItem);
        $this->assertCount(1, $this->simpleCart->getCart());
        $this->assertEquals(1, count($this->simpleCart->getCartCount()));
    }

    public function testAddMultipleItems()
    {
        $this->simpleCart->clearCart();

        $itemContext = [
            'name' => 'Red Balloon',
            'uniqueId' => 'R123',
            'amount' => 10.99,
            'quantity' => '3',
            'currency' => 'GBP'
        ];

        $addItem = $this->simpleCart->addItem($itemContext);

        $this->assertTrue($addItem);

        $itemContext = [
            'name' => 'Blue Balloon',
            'uniqueId' => 'B123',
            'amount' => 10.99,
            'quantity' => '6',
            'currency' => 'GBP'
        ];

        $addItem = $this->simpleCart->addItem($itemContext);

        $this->assertTrue($addItem);

        $this->assertCount(2, $this->simpleCart->getCart());
        $this->assertEquals(2, $this->simpleCart->getCartCount());
    }

    public function testUpdateItemByUniqueId()
    {
        $this->simpleCart->clearCart();

        $itemContext = [
            'name' => 'Red Balloon',
            'uniqueId' => 'R123',
            'amount' => 10.99,
            'quantity' => '3',
            'currency' => 'GBP'
        ];

        $addItem = $this->simpleCart->addItem($itemContext);

        $this->assertTrue($addItem);
        $this->assertEquals(1, $this->simpleCart->getCartCount());

        $updateItem = $this->simpleCart->updateItemQuantity('R123', 5);

        $this->assertTrue($updateItem);
        $this->assertEquals(1, $this->simpleCart->getCartCount());
    }

}
