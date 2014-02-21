<?php

namespace UserProfile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProfileController extends AbstractUserController
{

    public function indexAction()
    {

        throw new \Exception("Not implemented");
    }

    public function editAction(){

        $this->getUserPlugin()->requireAuth();



        return new ViewModel();
        //throw new \Exception("Not implemented");

    }



}

