<?php

namespace UserProfile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractProfileController
{

    public function userAction()
    {
        $user = $this->getEvent()->getRouteMatch()->getParam('user');
        $result = $this->getUserProfileService()->getUserProfile($user);
        if($result){
            return new ViewModel(array('user' => $result,
                'isOwner' => $this->getUserProfileService()->isProfileOwner($result['user_id'])));
        }
        return $this->notFoundAction();
    }

    public function friendsAction(){
        return new ViewModel();
    }

}

