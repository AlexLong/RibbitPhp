<?php

namespace UserProfile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserProfileController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }


}

