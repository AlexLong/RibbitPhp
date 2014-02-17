<?php

namespace UserProfile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserProfileController extends AbstractActionController
{

    public function indexAction()
    {
        $user = $this->getEvent()->getRouteMatch()->getParam('user');
        $userService = $this->getServiceLocator()->get('UserService');
        $result = $userService->getUserProfile($user);
        if($result){
            return new ViewModel(array('user' => $result,
                'isOwner' => $userService->isProfileOwner($result['user_id']) ));
        }
        return $this->notFoundAction();


    }


}

