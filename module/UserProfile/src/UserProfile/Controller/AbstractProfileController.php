<?php
/**
 * 
 * User: Windows
 * Date: 2/19/14
 * Time: 12:07 PM
 * 
 */

namespace UserProfile\Controller;


use UserProfile\Service\Interfaces\UserProfileServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;

class AbstractProfileController extends AbstractActionController{


   protected  $UserProfileService;

    /**
     * @param mixed $UserProfileService
     */
    public function setUserProfileService(UserProfileServiceInterface $UserProfileService)
    {
        $this->UserProfileService = $UserProfileService;
    }

    /**
     * @return mixed
     */
    public function getUserProfileService()
    {
        if(!$this->UserProfileService){

            $UserProfileService = $this->getServiceLocator()->get('UserProfileService');
            $this->setUserProfileService($UserProfileService);
        }

        return $this->UserProfileService;
    }



} 