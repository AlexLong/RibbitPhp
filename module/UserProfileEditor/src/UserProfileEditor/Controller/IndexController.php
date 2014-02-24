<?php

namespace UserProfileEditor\Controller;

use UserProfile\Controller\AbstractUserController;
use UserProfileEditor\Form\ProfileForm;
use UserProfileEditor\Form\ProfileFormModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractUserController
{

    public function indexAction()
    {

        throw new \Exception("Not implemented");
    }

    public function getFolderManager(){
        return $this->serviceLocator->get('userFolderManager');
    }

    public function profileAction(){

        $this->getUserPlugin()->requireAuth();

        $this->getFolderManager()->createProfileImageDir(12555487);

      $user =  $this->getAuthService()->getUserIdentify('username');
      $user_profile = $this->getServiceLocator()->get('UserProfileService')->getUserProfile($user);
        $profile_form = new ProfileForm();
        $profileModel = new ProfileFormModel();
        $profile_form->setInputFilter($profileModel->getInputFilter());
        $profile_form->setData($user_profile);

        //var_dump($profile_form);

        return new ViewModel(array('profile_form' => $profile_form));

    }

    function updateProfileAction(){
        $this->getUserPlugin()->requireAuth();

        if($this->getRequest()->isPost()){
            $request = $this->getRequest();
            $post = array_merge_recursive(
               $request->getPost()->toArray(),
                $request->getPost()->getFiles()->toArray()
            );
            $profile_form = new ProfileForm();
            $profile_form->setData($post);
            $profile_model = new ProfileFormModel();
            $profile_form->setInputFilter($profile_model->getInputFilter());
            $viewModel = new ViewModel(array('profile_form' => $profile_form));
            $viewModel->setTemplate('user-profile-editor/index/profile');
          return $viewModel;
        }

        throw new \Exception("Not Implemented");
    }





}

