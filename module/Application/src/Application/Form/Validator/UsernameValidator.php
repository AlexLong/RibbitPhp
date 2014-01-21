<?php
/**
 * 
 * User: Windows
 * Date: 1/21/14
 * Time: 10:01 PM
 * 
 */

namespace Application\Form\Validator;


use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class UsernameValidator extends  AbstractUserValidator {
    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return bool
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($post_data)
    {
        $user = $this->getUserRepository()->findByUsername($post_data,
            array('id','email' ,'password' ));

        if((!isset($user) || $user == null) )return false;

        return true;
    }



} 