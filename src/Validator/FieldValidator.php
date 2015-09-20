<?php
namespace SimpleCart\Validator;

use SimpleCart\Exception\InvalidFieldException;

class FieldValidator {

    /** @var array */
    private $fields;

    /** @var array */
    private $data;

    /**
     * @param array $fields
     * @return $this
     */
    public function setExpectedFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        if (empty($this->fields) || !is_array($this->fields)) {
            throw new InvalidFieldException(Validator::ERROR_NO_FIELDS);
        }

        $this->data = $data;
        return $this;
    }

    /**
     * @return bool
     */
    public function validateFields()
    {
        foreach ($this->fields as $field) {
            if (!in_array($field, array_keys($this->data))) {
                throw new InvalidFieldException(
                    sprintf(Validator::ERROR_FIELD_REQUIRED, $field)
                );
            }
        }

        return true;
    }

}