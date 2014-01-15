<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 12:45 PM
 * 
 */

namespace Application\Service\User;


use Application\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Application\Form\LoginForm;
use Application\Model\LoginModel;
use Application\Service\Interfaces\User\AuthenticationServiceInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\SessionManager;

class AuthenticationService implements  AuthenticationServiceInterface, ServiceLocatorAwareInterface {

    protected $user_repository;

    protected $sessionManager;

    protected $loginForm;

    protected $loginModel;

    protected $validationMessages;


    protected $serviceLocator;

    protected $select = array('id','email' ,'password');

    const INVALID_EMAIL = "Invalid email/password. Please Try again.";

    //protected $formData = array();

    public function  authenticate($postData)
    {
        $form =  $this->getLoginForm()->setInputFilter($this->getLoginModel()->getInputFilter());
        $form->setData($postData);

        if(!$form->isValid())
        {
            $this->validationMessages[] =  self::INVALID_EMAIL; //$form->getMessages();
            return false;
        }
       $user = $this->getUserRepository()->findByEmail($postData['email'],
            $this->select);
        if((!isset($user)  || $user == null) ||
            ($user['password'] !== md5($postData['password']))){

            $this->validationMessages[] = self::INVALID_EMAIL;

            return false;
        }
        $this->getSessionManager()->getStorage()->offsetSet('user_id', $user['id']);

        if(isset($postData['remember_me']) && $postData['remember_me'] == true){
            $this->getSessionManager()->rememberMe();
        }


      return true;
    }

    public  function is_logged()
    {
        $ses = new SessionManager();
        $ses->getStorage()->offsetExists('user_id');
      if(!$this->getSessionManager()->isValid() || !$this->getSessionManager()->getStorage()->offsetExists('user_id')){
        return false;
      }



          return true;



    }


    /**
     * @param mixed $loginForm
     */
    public function setLoginForm(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }

    /**
     * @return mixed
     */
    public function getLoginForm()
    {
        return $this->loginForm;
    }

    /**
     * @param mixed $loginModel
     */
    public function setLoginModel(LoginModel $loginModel)
    {
        $this->loginModel = $loginModel;
    }

    /**
     * @return mixed
     */
    public function getLoginModel()
    {
        return $this->loginModel;
    }

    /**
     * @param mixed $sessionManager
     */
    public function setSessionManager(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    /**
     * @return mixed
     */
    public function getSessionManager()
    {
        return $this->sessionManager;
    }

    /**
     * @param mixed $user_repository
     */
    public function setUserRepository(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * @return mixed
     */
    public function getUserRepository()
    {
        return $this->user_repository;
    }

    /**
     * @param mixed $ValidationMessages
     */
    public function setValidationMessages($ValidationMessages)
    {
        $this->ValidationMessages = $ValidationMessages;
    }

    /**
     * @return mixed
     */
    public function getValidationMessages()
    {
        return $this->validationMessages;
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;

    }


} 