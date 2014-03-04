<?php
/**
 * 
 * User: Windows
 * Date: 1/30/14
 * Time: 12:54 PM
 * 
 */

namespace UserAuc\Controller;

use UserProfile\Controller\AbstractUserController;
use UserProfileEditor\Service\UserDirService;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

use UserAuc\Model\ChkModel;

class IndexController extends  AbstractUserController {

    protected $chkModel;

    protected $dirService;


    public function chkUserAction()
    {
        if($this->request->isPost()){
           $data = $this->request->getPost();
         return $this->getChkModel()->buildResponse($data);
        }
        return new \Zend\View\Model\JsonModel(array(-1));
    }
    public function getChkModel()
    {
        if(!$this->chkModel){
            $this->setChkModel(new ChkModel());
        }
        return $this->chkModel;
    }

    public function setChkModel(ChkModel $model){
      $model->setSignForm($this->getServiceLocator()->get('SignForm'));
      $this->chkModel = $model;
      return $this;
    }

    public function loginAction()
    {
        $this->getUserPlugin()->signedUserRedirect();

        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            $form = $this->getServiceLocator()->get('LoginForm');
            $form->setData($data);
            if(!$form->isValid() || !$this->getAuthService()->authenticate($data)){
                return new ViewModel(array('validation_messages' => $form->getDefaultMessage(),
                    'failed_form' => $form));
            }
            if($this->getUserPlugin()->hasReturnUri())
            {
                return $this->getUserPlugin()->redirectToReturnUri();
            }
            return  $this->getUserPlugin()->redirectToHome();
        }
        if($this->getRequest()->getQuery('rt') != null)
        {

            $this->getUserPlugin()->generateReturnUri($this->getRequest()->getQuery('rt'));

        }
        return new ViewModel();
    }

    public function signAction()
    {

        if($this->getRequest()->isPost()){

            $data = $this->getRequest()->getPost();

            $signForm = $this->getServiceLocator()->get('SignForm');
            $signForm->setData($data);
            if(!$signForm->isValid())
            {
                return new ViewModel(array('failed_form' => $signForm));
            }
            if($this->getAuthService()->signUp($data)){



                return $this->getUserPlugin()->redirectToHome();
            }
        }

        return new ViewModel();
    }

    public function logoutAction()
    {
        $this->layout()->terminate(0);

        $this->getAuthService()->logout();

        if($this->getRequest()->getQuery('rt') != null)
        {
            $rt = $this->getRequest()->getQuery('rt');

            if($this->getUserPlugin()->validateReturnUri($rt))
            {
                return  $this->redirect()->toUrl($rt);
            }
        }
        return $this->getUserPlugin()->redirectToIndex();
    }


} 