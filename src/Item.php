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
use SimpleCart\Model\ItemModel;
use SimpleCart\Validator\ItemValidator;

/**
 * @author Gaurav Malhotra <gaurav@level5websites.com>
 * @license MIT
 */
class Item
{

    /**
     * @param string $uniqueId
     * @param array $cartItems
     * @return ItemModel
     */
    public function getItemByUniqueId($uniqueId, array $cartItems)
    {
        /** @var ItemModel $cart */
        foreach ($cartItems as $cart) {
            if ($cart->getUniqueId() == $uniqueId) {
                return $cart;
            }
        }

        throw new InvalidFieldException('Unique ID not found');
    }

    /**
     * @param array $data
     * @param array $cart
     * @return bool
     */
    public function itemUpdateRequired(array $data, array $cart)
    {
        try {
            $this->getItemByUniqueId($data['uniqueId'], $cart);
            return true;
        } catch (InvalidFieldException $e) {
            return false;
        }
    }

    /**
     * @param array $data
     * @return ItemModel
     */
    public function getItemModel($data)
    {
        if (empty($data) || !is_array($data)) {
            throw new \InvalidArgumentException("Item to add is either empty or not an array");
        }

        $itemValidator = new ItemValidator();
        $itemValidator->setData($data);
        $itemValidator->validate();

        $item = $this->generateModel($data);

        return $item;
    }

    /**
     * @param array $data
     * @return ItemModel
     */
    private function generateModel($data)
    {
        $itemModel = new ItemModel();
        $itemModel->setUniqueId($data['uniqueId'])
                  ->setName($data['name'])
                  ->setAmount($data['amount'])
                  ->setQuantity($data['quantity'])
                  ->setCurrency($data['currency']);

        return $itemModel;
    }

}