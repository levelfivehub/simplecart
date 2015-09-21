<?php
namespace SimpleCart;

use SimpleCart\Exception\InvalidFieldException;
use SimpleCart\Model\ItemModel;
use SimpleCart\Validator\ItemValidator;

class Item
{

    /**
     * @param $uniqueId
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