<?php
/**
 * 
 * User: Windows
 * Date: 1/21/14
 * Time: 10:02 PM
 * 
 */

namespace UserProfile\Form\Validator;


use UserProfile\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Zend\Validator\AbstractValidator;

abstract class AbstractUserValidator extends  AbstractValidator{


    protected  $userRepository;

    public  function __construct(array $options = null)
    {

        parent::__construct($options);
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