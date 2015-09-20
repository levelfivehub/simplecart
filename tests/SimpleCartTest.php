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
    }

    public function testAddItemToCart()
    {
        $this->markTestIncomplete('Working on SimpleCart');

        $itemName = 'Red Balloon';
        $quantity = 5;
        $pricePerItem = '11.99';

        $addItem = $this->simpleCart->addItem($itemName, $quantity, $pricePerItem);

        $this->assertTrue($addItem);
        $this->assertCount(1, count($this->simpleCart->getCartCount()));

        $item = $this->simpleCart->getItemByName('Red Balloon');

        $this->assertEquals($itemName, $item->getName());
    }

}
