<?php
namespace SimpleCart\Exception;

class ValidationException extends \InvalidArgumentException implements ExceptionInterface {

    const ERROR_MESSAGE = 'Validation errors occurred';

    /** @var array */
    private $errors;

    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE);
    }

    /**
     * @param $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}