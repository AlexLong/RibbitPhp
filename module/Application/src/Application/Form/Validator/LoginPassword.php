<?php
/**
 * 
 * User: Windows
 * Date: 2/3/14
 * Time: 9:04 PM
 * 
 */

namespace Application\Form\Validator;


use Zend\Stdlib\ArrayUtils;
use Zend\Validator\Exception;

class LoginPassword extends  AbstractUserValidator {

    protected $email;
    protected $emailString;


    const MISSING_EMAIL = 'missingEmail';

    public function __construct($email = null){

        if ($email instanceof \Traversable) {
            $email = ArrayUtils::iteratorToArray($email);
        }

        if (is_array($email) && array_key_exists('email', $email)) {

            $this->setEmail($email['email']);

        } elseif (null !== $email) {
            $this->setEmail($email);
        }

        parent::__construct(is_array($email) ? $email : null);

    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->emailString = (is_array($email) ? var_export($email, true) : (string) $email);
        $this->email       = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }



    public function isValid($value,array $context = null)
    {

        $this->setValue($value);

        $email = $this->getEmail();
        if($context !== null){
            if (is_array($email)) {
                while (is_array($email)) {
                    $key = key($email);
                    if (!isset($context[$key])) {
                        break;
                    }
                    $context = $context[$key];
                    $email   = $email[$key];
                }
        }

            if (is_array($email) || !isset($context[$email])) {
                $email = $this->getEmail();
            } else {
                $email = $context[$email];
            }

            if ($email === null) {
                $this->error(self::MISSING_EMAIL);
                return false;
            }

      //    $password = $this->getUserRepository()->findByEmail()

        }
    }



} 