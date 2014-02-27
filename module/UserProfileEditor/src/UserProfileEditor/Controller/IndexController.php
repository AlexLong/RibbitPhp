<?php

namespace UserProfileEditor\Controller;

use UserProfile\Controller\AbstractUserController;
use UserProfileEditor\Form\ProfileForm;
use UserProfileEditor\Form\ProfileFormModel;
use Zend\Form\Form;
use Zend\Http\Response;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractUserController
{

    protected $profileForm;



    public function indexAction()
    {

        throw new \Exception("Not implemented");
    }

    public function getFolderManager(){
        return $this->serviceLocator->get('userDirManager');
    }

    public function profileAction(){

        $this->getUserPlugin()->requireAuth();
        $user = $this->getAuthService()->getUserIdentify('username');
        $user_profile = $this->getServiceLocator()->get('UserProfileService')->getUserProfile($user);

        $profile_form = $this->getProfileForm();
        $profile_form->setData($user_profile);

        $url =  $this->url()->fromRoute("private_profile/p_child",array('action' => 'updateProfile'));
        $rpg = $this->fileprg($profile_form,$url);
        $tmpFile = null;
        // Repg Will redirect back to action once uploading filtering of a file is done.
        if($rpg instanceof Response) return $rpg;
        elseif(is_array($rpg)){
            if($profile_form->isValid()){
                $element = $profile_form->get('profile_picture');
               // var_dump($profile_form->getData());
                $tmpFile = $element->getValue();

            }else{
                $element = $profile_form->get('profile_picture');
                $errorMessages = $element->getMessages();
                if(empty($errorMessages)){
                    $tmpFile = $element->getValue();
                }
            }
        }


        return new ViewModel(array('profile_form' => $profile_form, 'tmp_file' => $tmpFile));

    }
    function updateProfileAction(){
        $this->getUserPlugin()->requireAuth();

      $profile_form = $this->getProfileForm();
      $url =  $this->url()->fromRoute("private_profile/p_child",array('action' => 'profile'));
      $rpg = $this->fileprg($profile_form,$url,true);
        if($rpg instanceof Response){
            return $rpg;
        }
            return $this->notFoundAction();
    }
    public function getProfileForm(){
        return $this->serviceLocator->get('profileEditForm');
    }




}

