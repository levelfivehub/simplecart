<?php
namespace SimpleCart\Validator;

use SimpleCart\Model\ErrorModel;

class Validator {

    /**
     * @var array
     */
    private $errors;

    /**
     * @param $name
     * @param $message
     * @return bool
     */
    public function addError($name, $message)
    {
        $errorModel = new ErrorModel();
        $errorModel->setName($name);
        $errorModel->setMessage($message);

        $this->errors[] = $errorModel;

        return true;
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