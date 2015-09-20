<?php
namespace SimpleCart;

use SimpleCart\Model\ItemModel;

class Item
{

    /**
     * @param $id
     * @param $name
     * @param $amount
     * @param $quantity
     * @param null $currency
     * @return ItemModel
     */
    public function generateModel($id, $name, $amount, $quantity, $currency = null)
    {
        $itemModel = new ItemModel();
        $itemModel->setUniqueId($id)
                  ->setName($name)
                  ->setAmount($amount)
                  ->setQuantity($quantity)
                  ->setCurrency($currency);

        return $itemModel;
    }

}