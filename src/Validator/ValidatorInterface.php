<?php
namespace SimpleCart\Validator;

interface ValidatorInterface {

    public function setData();

    public function validate();

    public function addError();

    public function hasErrors();

    public function getErrors();

}