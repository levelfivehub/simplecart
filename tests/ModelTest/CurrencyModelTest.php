<?php
namespace SimpleCartTest;

use PHPUnit_Framework_TestCase;
use SimpleCart\Model\CurrencyModel;

class CurrencyModelTest extends PHPUnit_Framework_TestCase {

    private $currencyModel;

    public function setUp()
    {
        $this->currencyModel = new CurrencyModel();
    }

    public function testCurrencyModel()
    {
        $context = [
            'code' => 'GBP',
            'name' => 'UK Pounds',
            'country' => 'United Kingdom'
        ];

        $model = $this->currencyModel->setCode($context['code'])
                                     ->setName($context['name'])
                                     ->setCountry($context['country']);

        $this->assertEquals($model->getCode(), $context['code']);
        $this->assertEquals($model->getName(), $context['name']);
        $this->assertEquals($model->getCountry(), $context['country']);
    }

}
