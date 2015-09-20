<?php
namespace SimpleCart;

use SimpleCart\Item;
use Zend\Session\Container;

class SimpleCart extends Item {

    /**
     * @var Container
     */
    private $container;

    /**
     * @param string $cartName
     */
    public function __construct($cartName)
    {
        $this->container = new Container($cartName);
    }

}