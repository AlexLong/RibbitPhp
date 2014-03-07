<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 1:09 AM
 * 
 */

namespace UserAuc\Form\Validator;



use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class EmailExists extends  AbstractUserValidator {

    const ERROR_EMAIL_FOUND    = 'emailFound';
    const ERROR_EMAIL_NOT_FOUND    = 'emailNotFound';
    const INVALID_LOGIN    = 'invalidLogin';

    protected $messageTemplates = array(
        self::ERROR_EMAIL_FOUND    => "Email address is already in use.",
        self::ERROR_EMAIL_NOT_FOUND    => "Email Doesn't exist.",
        self::INVALID_LOGIN   => "Invalid email/password.",

    );

    protected $login;

    public  function __construct(array $options = null)
    {
        $this->login =(is_array($options) && array_key_exists('login', $options)) ? $options['login'] :  false;

        parent::__construct($options);
    }

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
        $valid = true;

        $user = $this->getUserTable()->findByEmail($post_data,
            array('email'));

        if(($user != null) || (is_array($user) && count($user) > 0) ) {

            if($this->login){
                $valid = true;
            }else{
                $this->error(self::ERROR_EMAIL_FOUND);
                $valid = false;
            }
        }elseif(true == $this->login && (($user == null) || (is_array($user) && count($user) == 0))){

            $this->error(self::INVALID_LOGIN);
            $valid = false;
        }
        return $valid;
    }
} 