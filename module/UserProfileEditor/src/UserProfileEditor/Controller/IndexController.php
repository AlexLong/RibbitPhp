<?php

namespace UserProfileEditor\Controller;

use UserProfile\Controller\AbstractUserController;
use UserProfile\Service\UserProfileService;
use UserProfileEditor\Entity\EditProfile;
use UserProfileEditor\Entity\ProfilePicture;
use UserProfileEditor\Form\PictureForm;
use UserProfileEditor\Form\ProfileForm;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractUserController
{

    protected $profileForm;

    protected $pictureForm;

    /**
     * @var UserProfileService
     */
    protected $profileService;



    public function OnDispatch(MvcEvent $e){
        $this->getUserPlugin()->requireAuth();
        parent::onDispatch($e);

    }

    public function indexAction()
    {

        throw new \Exception("Not implemented");
    }
    public function profileAction(){

          if($this->getRequest()->isPost()){
              $profile_form = $this->getProfileForm();
              $profile_form->setData($this->getRequest()->getPost());
              if($profile_form->isValid()){
                  $edit_profile = new EditProfile($profile_form->getData());
                  $update = $edit_profile->toUpdate($this->getAuthService()->getUserIdentify());
                  $updated_data = $this->getProfileService()->updateProfile($update);
                  $profile_form->setData($updated_data);
              }
          }else{
              $user = $this->getAuthService()->getUserIdentify('username');
              $user_profile = $this->getServiceLocator()->get('UserProfileService')->getUserProfile($user);
              $profile_form = $this->getProfileForm();
              $profile_form->setData($user_profile);
          }


        return new ViewModel(array('profile_form' => $profile_form));
    }

    /*
    public function updateProfileAction(){
        $model = new ViewModel();

        if($this->getRequest()->isPost()){
            $profile_form = $this->getProfileForm();
            $profile_form->setData($this->getRequest()->getData());
            if($profile_form->isValid()){
                $edit_profile = new EditProfile($profile_form->getData());
                $update = $edit_profile->toUpdate($this->getAuthService()->getUserIdentify());
                $updated_data = $this->getProfileService()->updateProfile($update);
                $profile_form->setData($updated_data);
               return $this->redirect()->toRoute(null,array('action' => 'profile'));
            }
        }
    }
    */

    public function pictureAction(){

        $model = new ViewModel();
        $model->setTemplate('profile_editor/picture');
        if($this->getRequest()->isGet()){
            $picture = $this->getAuthService()->getUserIdentify('profile_picture');
            $model->setVariables(array('picture' => $picture, 'picture_form' => $this->getPictureForm()));
            return $model;
        }
         $post_data = array_merge_recursive(array(
            $this->getRequest()->getFiles(),
            $this->getRequest()->getPost()
        ));
        $picture_form = $this->getProfileForm();
        $picture_form->setData($post_data);

        $url =  $this->url()->fromRoute("private_profile/p_child",array('action' => 'updateProfile'));
        $rpg = $this->fileprg($picture_form,$url);

        $picture = null;
        if($rpg instanceof Response){
            return $rpg;
        }elseif(is_array($rpg)){
            if($picture_form->isValid()){
                $changed_picture = new ProfilePicture($picture_form->getData());
                $updated_data = $this->getProfileService()->updateProfile($changed_picture->getParsedName());
            }else{
                $element = $picture_form->get('profile_picture');
                $errorMessages = $element->getMessages();
                if(empty($errorMessages)){
                    $picture = $element->getValue();

                }
            }
        }
        $model->setVariables(array('picture' => $picture, 'picture_form' => $this->getPictureForm()));
        return $model;

    }

    function updatePictureAction(){
        $this->getUserPlugin()->requireAuth();
        $picture_form = $this->getPictureForm();
        $url =  $this->url()->fromRoute("private_profile/p_child",array('action' => 'picture'));
        $rpg = $this->fileprg($picture_form,$url,true);
        if($rpg instanceof Response){
            return $rpg;
        }
        return $this->notFoundAction();
    }

    /**
     * @return ProfileForm
     */

    public function getProfileForm(){
        if(!$this->profileForm){
            $this->profileForm = $this->serviceLocator->get('profileEditForm');
        }
        return $this->profileForm;
    }


    /**
     * @return UserProfileService
     */
    public function getProfileService()
    {
        if(!$this->profileService){

           $this->profileService = $this->serviceLocator->get('UserProfileService');
        }
        return $this->profileService;
    }

    /**
     * @return PictureForm
     */
    public function getPictureForm()
    {
        if(!$this->pictureForm){
            $this->getServiceLocator()->get('pictureEditForm');
        }
        return $this->pictureForm;
    }


}

