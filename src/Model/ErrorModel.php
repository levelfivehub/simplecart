<?php
namespace SimpleCart\Model;

class ErrorModel {

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $messages;

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * @param array $message
     * @return $this
     */
    public function setMessages($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

}