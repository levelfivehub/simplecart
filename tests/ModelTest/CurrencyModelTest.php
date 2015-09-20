<?php
namespace SimpleCartTest;

use PHPUnit_Framework_TestCase;

class CurrencyModelTest extends PHPUnit_Framework_TestCase {

    private $currencyModel;

    public function setUp()
    {
        $this->currencyModel = new CurrencyModel();
    }

}
