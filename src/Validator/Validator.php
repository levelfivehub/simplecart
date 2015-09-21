<?php
namespace SimpleCart\Validator;

use SimpleCart\Model\ErrorModel;
use SimpleCart\Exception\ValidationException;

class Validator {

    const ERROR_NO_FIELDS = 'No fields specified to validate';
    const ERROR_FIELD_REQUIRED = '%s field is required to validate';
    const ERROR_NOT_EMPTY = 'This field is empty';
    const ERROR_NOT_STRING = 'This field is not a string';
    const ERROR_NOT_INTEGER = 'This field is not an integer/number';
    const ERROR_NOT_ARRAY = 'This field is not an array';
    const ERROR_NOT_AMOUNT = 'This field is not a valid amount price in the format 00.00';

    /** @var array */
    private $data;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var FieldValidator
     */
    private $fieldValidator;

    public function __construct()
    {
        $this->fieldValidator = new FieldValidator();
    }

    /**
     * @return bool
     */
    public function confirmValidation()
    {
        if ($this->getErrors()) {
            $validation = new ValidationException();
            $validation->setErrors($this->getErrors());

            throw $validation;
        }

        return true;
    }

    /**
     * @param array $fields
     * @param array $data
     * @return bool
     */
    public function validateFields(array $fields, array $data)
    {
        $this->fieldValidator->setExpectedFields($fields);
        $this->fieldValidator->setData($data);
        return $this->fieldValidator->validateFields();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $name
     * @param $message
     * @return bool
     */
    public function addError($name, $message)
    {
        $error = $this->getErrorByName($name);
        $error->addMessage($message);
        $this->errors[] = $error;

        return true;
    }

    /**
     * @param $name
     * @return ErrorModel
     */
    private function getErrorByName($name)
    {
        if (!empty($this->errors)) {
            /** @var ErrorModel $error */
            foreach ($this->errors as $error) {
                if ($error->getName() == $name) {
                    return $error;
                }
            }
        }

        return (new ErrorModel())->setName($name);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function getErrorCount()
    {
        return count($this->errors);
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return (!empty($this->errors));
    }

}