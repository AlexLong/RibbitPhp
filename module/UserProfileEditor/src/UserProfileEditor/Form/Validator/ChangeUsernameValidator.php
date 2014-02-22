<?php
/**
 * 
 * User: Windows
 * Date: 2/22/14
 * Time: 2:04 PM
 * 
 */

namespace UserProfileEditor\Form\Validator;


use UserAuc\Form\Validator\UsernameExists;
use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class ChangeUsernameValidator extends UsernameExists{


    public $authService;


    public function __construct($options = array()){

        parent::__construct($options);
    }

    public function isValid($value)
    {
     $user = $this->getAuthService()->getUserIdentify('username');
     if( ($user != $value) && !parent::isValid($value))
     {
         $this->error(self::ERROR_USER_FOUND);
         return false;
     }
      return true;
    }

    /**
     * @return mixed
     */
    public function getAuthService()
    {
        return $this->authService;
    }



}