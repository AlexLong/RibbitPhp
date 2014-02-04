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
use Zend\Mvc\Controller\Plugin\Params;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\SessionManager;
use Zend\Stdlib\Parameters;

class AuthenticationService   implements  AuthenticationServiceInterface, ServiceLocatorAwareInterface {

    protected $user_repository;

    protected $sessionManager;

    protected $validationMessages;

    protected $serviceLocator;

    protected $userIdentify;

    protected $defaultUserId  = 'user_id';

    protected $underDev = false;

    protected $select = array('id','email' ,'password');


    public  function signUp($postData, $role = 'user')
    {

        $postData['role'] = $role;

        $this->getUserRepository()->createUser((array)$postData);
        return $this->authenticate($postData);
    }
    public function authenticate($postData)
    {

       $user = $this->getUserRepository()->findByEmail($postData['email'],
            $this->select);
        if( ($user == null  || count($user) == 0) ||  $user['password'] != md5($postData['password'])){
         return false;
        }
        $this->getSessionManager()->getStorage()->offsetSet($this->defaultUserId, $user['id']);

        if(isset($postData['remember_me']) && $postData['remember_me'] == true && !$this->underDev){
           $this->getSessionManager()->rememberMe();
        }
      return true;
    }

    public  function is_identified()
    {
      if(!$this->getSessionManager()->isValid() || !$this->getSessionManager()->getStorage()->offsetExists($this->defaultUserId)){
        return false;
      }
          return true;
    }
    public  function logout()
    {
        if($this->getSessionManager()->getStorage()->offsetExists($this->defaultUserId))
        {
           $this->getSessionStorage()->offsetUnset($this->defaultUserId);
        }

        return true;
    }

    public  function removeUser($userId)
    {
        return $this->getUserRepository()->dropById($userId);
    }
    /**
     * @return mixed
     */
    public function getUserIdentify()
    {
        $identity = null;

        if($this->is_identified())
        {
            $identity = $this->getSessionManager()->getStorage()->offsetGet('user_id');
        }
        return $identity;
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

    public function getSessionStorage()
    {
        return $this->getSessionManager()->getStorage();
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

    /**
     * @param boolean $underDev
     */
    public function setUnderDev($underDev)
    {
        $this->underDev = $underDev;
    }

    /**
     * @return boolean
     */
    public function getUnderDev()
    {
        return $this->underDev;
    }




} 