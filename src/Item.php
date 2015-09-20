<?php
namespace SimpleCart;

use SimpleCart\Model\ItemModel;
use SimpleCart\Validator\ItemValidator;

class Item
{

    /**
     * @var ItemValidator
     */
    private $itemValidator;

    public function __construct()
    {
        $this->itemValidator = new ItemValidator();
    }

    /**
     * @param ItemModel|array $data
     */
    public function addItem($data)
    {
        if (empty($data) || !is_array($data)) {
            throw new \InvalidArgumentException("Item to add is either empty or not an array");
        }

        $this->itemValidator->setData($data);
        $this->itemValidator->validate();
    }

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