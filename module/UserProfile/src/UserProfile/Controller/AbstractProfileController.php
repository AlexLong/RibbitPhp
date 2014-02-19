<?php
/**
 * 
 * User: Windows
 * Date: 2/19/14
 * Time: 12:07 PM
 * 
 */

namespace UserProfile\Controller;


use UserProfile\Service\Interfaces\UserServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;

class AbstractProfileController extends AbstractActionController{


   protected  $userService;

    /**
     * @param mixed $userService
     */
    public function setUserService(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return mixed
     */
    public function getUserService()
    {
        if(!$this->userService){

            $userService = $this->getServiceLocator()->get('UserService');
            $this->setUserService($userService);
        }

        return $this->userService;
    }



} 