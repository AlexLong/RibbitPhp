<?php

namespace UserProfile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserProfileController extends AbstractProfileController
{

    public function indexAction()
    {
        $user = $this->getEvent()->getRouteMatch()->getParam('user');
        $result = $this->getUserService()->getUserProfile($user);
        if($result){
            return new ViewModel(array('user' => $result,
                'isOwner' => $this->getUserService()->isProfileOwner($result['user_id'])));
        }
        return $this->notFoundAction();
    }





}

