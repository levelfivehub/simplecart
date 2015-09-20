<?php
namespace SimpleCart;

use Zend\Session\Container;
use SimpleCart\Model\ItemModel;

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

    /**
     * @param array $data
     * @return bool
     */
    public function addItem(array $data)
    {
        $itemModel = $this->getItemModel($data);
        $newCart = array_merge([ $itemModel ], $this->getCart());
        $this->container->offsetSet('cart', $newCart);

        return true;
    }

    /**
     * @param $uniqueId
     * @param $quantity
     * @return bool
     */
    public function updateItemQuantity($uniqueId, $quantity)
    {
        $cart = $this->getCart();

        /** @var ItemModel $item */
        $item = $this->getItemByUniqueId($uniqueId, $cart);
        $item->setQuantity($quantity);

        $this->container->offsetSet('cart', $cart);

        return true;
    }

    /**
     * @return array
     */
    public function getCart()
    {
        $cart = $this->container->offsetGet('cart');

        if (!$cart) {
            $cart = [];
        }

        return $cart;
    }

    /**
     * @return int
     */
    public function getCartCount()
    {
        return count($this->getCart());
    }

    /**
     * @return bool
     */
    public function clearCart()
    {
        $this->container->offsetUnset('cart');
        return true;
    }

}