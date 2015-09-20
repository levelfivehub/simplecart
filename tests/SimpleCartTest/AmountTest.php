<?php
namespace SimpleCartTest;

use SimpleCart\Amount;

class AmountTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Amount
     */
    private $amount;

    public function setUp()
    {
        $this->amount = new Amount();
    }

    public function testDisplayPrice()
    {
        $context = '1099';
        $this->assertEquals('10.99', $this->amount->display_price($context));
    }

    public function testIntPrice()
    {
        $context = '10.99';
        $this->assertEquals('1099', $this->amount->compute_price($context));
    }

    public function testCleanPrice()
    {
        $context = '10.99';
        $this->assertEquals('10.99', $this->amount->clean_price($context));
    }
}
