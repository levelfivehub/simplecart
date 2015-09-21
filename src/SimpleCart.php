<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */
namespace SimpleCart;

use SimpleCart\Exception\InvalidFieldException;
use SimpleCart\Exception\InvalidItemException;
use Zend\Session\Container;
use SimpleCart\Model\ItemModel;

/**
 * @author Gaurav Malhotra <gaurav@level5websites.com>
 * @license MIT
 */
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
        $cart = $this->getCart();

        if ($this->itemUpdateRequired($data, $cart)) {
            throw new InvalidItemException('Item already exists in cart.  Update is required.');
        }

        $itemModel = $this->getItemModel($data);
        $newCart = array_merge([ $itemModel ], $cart);
        $this->container->offsetSet('cart', $newCart);

        return true;
    }

    /**
     * @param string $uniqueId
     * @param int $quantity
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
     * @param string $uniqueId
     * @return bool
     */
    public function removeItem($uniqueId)
    {
        $cart = $this->getCart();

        /** @var ItemModel $item */
        $this->getItemByUniqueId($uniqueId, $cart);

        /** @var ItemModel $cartItem */
        foreach ($cart as $key => $cartItem) {
            if ($cartItem->getUniqueId() == $uniqueId) {
                unset($cart[$key]);
                continue;
            }
        }

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