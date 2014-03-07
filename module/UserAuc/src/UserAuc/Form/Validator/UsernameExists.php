<?php
/**
 * 
 * User: Windows
 * Date: 1/21/14
 * Time: 10:01 PM
 * 
 */

namespace UserAuc\Form\Validator;


use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class UsernameExists extends  AbstractUserValidator {
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
    const ERROR_USER_FOUND    = 'userFound';

    protected $messageTemplates = array(
        self::ERROR_USER_FOUND    => "Specified username is already in use.",
    );

    public  function __construct(array $options = null)
    {
        parent::__construct($options);
    }
    public function isValid($post_data)
    {
        $valid = true;

        $user = $this->getUserTable()->findByUsername($post_data,
            array('username'));

        if(($user != null) || (is_array($user) && count($user) > 0) ) {
            $this->error(self::ERROR_USER_FOUND);
            $valid = false;
        }
        return $valid;
    }



} 