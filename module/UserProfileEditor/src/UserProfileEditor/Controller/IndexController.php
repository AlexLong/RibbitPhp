<?php

namespace UserProfileEditor\Controller;

use UserProfile\Controller\AbstractUserController;
use UserProfileEditor\Form\ProfileForm;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractUserController
{

    public function indexAction()
    {

        throw new \Exception("Not implemented");
    }


    public function profileAction(){

        $this->getUserPlugin()->requireAuth();

      $user =  $this->getAuthService()->getUserIdentify('username');
      $user_profile = $this->getServiceLocator()->get('UserProfileService')->getUserProfile($user);
        $profile_form = new ProfileForm();
        $profile_form->setData($user_profile);

        //var_dump($profile_form);

        return new ViewModel(array('profile_form' => $profile_form));

    }

    function updateProfileAction(){
        $this->getUserPlugin()->requireAuth();

        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            var_dump($data);
            $profile_form = new ProfileForm();
            $profile_form->setData($data);
            $viewModel = new ViewModel(array('profile_form' => $profile_form));
            $viewModel->setTemplate('user-profile-editor/index/profile');
          return $viewModel;
        }

        throw new \Exception("Not Implemented");
    }





}

