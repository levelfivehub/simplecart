<?php
namespace SimpleCart;

class Amount {

    /**
     * @param $price
     * @return string
     */
    public function display_price($price)
    {
        $price = $this->clean_price($price);
        $price = $price / 100;
        return number_format($price, 2);
    }

    /**
     * @param $price
     * @return int
     */
    public function compute_price($price)
    {
        $price = $this->clean_price($price);
        return ($price)? (intval(round(round($price, 2)*100))) : 0;
    }

    /**
     * @param $price
     * @return float|mixed
     */
    public function clean_price($price)
    {
        $price = str_replace(',', '', $price);
        $price = floatval($price);
        return $price;
    }

}