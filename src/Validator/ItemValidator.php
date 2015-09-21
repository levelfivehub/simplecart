<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */
namespace SimpleCart\Validator;

use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;

/**
 * @author Gaurav Malhotra <gaurav@level5websites.com>
 * @license MIT
 */
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