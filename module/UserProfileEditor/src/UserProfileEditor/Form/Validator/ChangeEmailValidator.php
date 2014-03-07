<?php
/**
 * 
 * User: Windows
 * Date: 2/22/14
 * Time: 12:54 PM
 * 
 */

namespace UserProfileEditor\Form\Validator;


use Zend\Validator\EmailAddress;

class ChangeEmailValidator extends EmailAddress {


    const INVALID  = 'emailAddressInvalid';

    const CURRENT_EMAIL = 'currentEmail';

    const EMAIL_BUSY = 'emailInUse';


    protected $currentEmail;

    protected $userTable;



    protected $messageTemplates = array(
       self::INVALID => "The input is not a valid email address",
       self::CURRENT_EMAIL => "This is your current email",
       self::EMAIL_BUSY => "Entered email is already in use"
    );


    public function __construct($options = array()){
        parent::__construct($options);

    }

    public function isValid($value){

        if(!parent::isValid($value)){
            $this->error(self::INVALID);
            return false;
        }

        if($value == $this->getCurrentEmail()){
            $this->setMessage(self::CURRENT_EMAIL);
            return true;
        }

        $user = $this->getUserTable()->findByEmail($value,
            array('email'));

        if(($user != null) || (is_array($user) && count($user) > 0) ) {
            $this->error(self::EMAIL_BUSY);
            return false;

        }
        return true;
    }

    /**
     * @param mixed $currentEmail
     */
    public function setCurrentEmail($currentEmail)
    {
        $this->currentEmail = $currentEmail;
    }

    /**
     * @return mixed
     */
    public function getCurrentEmail()
    {
        return $this->currentEmail;
    }

    /**
     * @param mixed $userTable
     */
    public function setUserTable($userTable)
    {
        $this->userTable = $userTable;
    }

    /**
     * @return mixed
     */
    public function getUserTable()
    {
        return $this->userTable;
    }


} 