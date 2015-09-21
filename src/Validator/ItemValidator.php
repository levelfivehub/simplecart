<?php
namespace SimpleCart\Validator;

use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;

class ItemValidator extends Validator implements ValidatorInterface {

    /**
     * @return array
     */
    private function getFieldsForValidation()
    {
        return [
            'uniqueId',
            'name',
            'amount',
            'quantity'
        ];
    }

    /**
     * @return bool
     */
    public function validate()
    {
        $this->validateFields($this->getFieldsForValidation(), $this->getData());

        $data = $this->getData();

        $notEmpty = new NotEmpty();
        $stringLength = new StringLength();
        $digits = new Digits();

        if (!$notEmpty->isValid($data['name'])) {
            $this->addError('Name', Validator::ERROR_NOT_EMPTY);
        }

        if (!$stringLength->isValid($data['name'])) {
            $this->addError('Name', Validator::ERROR_NOT_STRING);
        }

        if (!$notEmpty->isValid($data['amount'])) {
            $this->addError('Amount', Validator::ERROR_NOT_EMPTY);
        }

        if (!is_float($data['amount'])) {
            $this->addError('Amount', Validator::ERROR_NOT_AMOUNT);
        }

        if (!$notEmpty->isValid($data['quantity'])) {
            $this->addError('Quantity', Validator::ERROR_NOT_EMPTY);
        }

        if (!$digits->isValid($data['quantity'])) {
            $this->addError('Quantity', Validator::ERROR_NOT_INTEGER);
        }

        if (!$notEmpty->isValid($data['uniqueId'])) {
            $this->addError('uniqueId', Validator::ERROR_NOT_EMPTY);
        }

        if (!$stringLength->isValid($data['uniqueId'])) {
            $this->addError('uniqueId', Validator::ERROR_NOT_STRING);
        }

        // Optional field: Currency
        if (isset($data['currency'])) {
            if (!$stringLength->isValid($data['currency'])) {
                $this->addError('currency', Validator::ERROR_NOT_STRING);
            }
        }

        return $this->confirmValidation();
    }


}