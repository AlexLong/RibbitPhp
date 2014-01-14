<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 1:09 AM
 * 
 */

namespace Application\Form\Validator;


use Application\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class EmailValidator extends  AbstractValidator {


    protected  $userRepository;


    public  function __construct(array $options = null)
    {

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
        $user = $this->getUserRepository()->findByEmail($post_data,
            array('id','email' ,'password' ));


        if((!isset($user) || $user == null) )return false;

        return true;
    }

    /**
     * @param mixed $userRepository
     */
    public function setUserRepository(UserRepositoryInterface $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function getUserRepository()
    {
        return $this->userRepository;
    }






} 