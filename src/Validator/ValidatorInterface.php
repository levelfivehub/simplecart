<?php
namespace SimpleCart\Validator;

use SimpleCart\Exception\ExceptionInterface;

interface ValidatorInterface {

    /**
     * @param array $data
     * @return bool|ExceptionInterface
     */
    public function setData(array $data);

    /**
     * @return bool
     */
    public function validate();

    /**
     * @param string $name
     * @param string $message
     * @return bool
     */
    public function addError($name, $message);

    public function hasErrors();

    public function getErrors();

}