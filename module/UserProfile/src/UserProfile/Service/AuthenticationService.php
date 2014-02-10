<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 12:45 PM
 * 
 */

namespace UserProfile\Service;

use UserProfile\Domain\DbLayerInterfaces\UserRepositoryInterface;
use UserProfile\Service\Interfaces\AuthenticationServiceInterface;
use UserProfile\Domain\DbLayerInterfaces\UserProfileRepositoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\SessionManager;


class AuthenticationService   implements  AuthenticationServiceInterface, ServiceLocatorAwareInterface {

    protected $user_repository;

    protected $sessionManager;

    protected $validationMessages;

    protected $serviceLocator;

    protected $userIdentify;

    protected $defaultUserId  = 'id';

    protected $underDev = false;

    protected $userCredentials = array();

    protected $requiredUserData = array('id','email','username' ,'password','role');

    protected $availableData =  array('id','email','username','role');

    /**
     *
     * Creates a new user based on submitted data.
     *
     * @param array $postData
     * @param string $role
     * @return bool
     */

    public  function signUp($postData, $role = 'user')
    {
        $postData['role'] = $role;
        $this->getUserRepository()->createUser((array)$postData);


        return $this->authenticate($postData);
    }

    /**
     * Authenticates user based on submitted data.
     *
     * @param $postData array
     * @return bool
     */
    public function authenticate($postData)
    {

       $user = $this->getUserRepository()->findByEmail($postData['email'],
            $this->requiredUserData);

        if( ($user === null  || count($user) == 0) ||  $user['password'] != md5($postData['password'])){
         return false;
        }

        foreach($this->availableData as $data){
            $this->getSessionManager()->getStorage()->offsetSet($data,$user[$data]);
        }

        if(isset($postData['remember_me']) && $postData['remember_me'] == true && !$this->underDev){
           $this->getSessionManager()->rememberMe();
        }
      return true;
    }
    /**
     * Checks user identity.
     *
     * @return bool
     */

    public  function is_identified()
    {
      if(!$this->getSessionManager()->isValid() || !$this->getSessionManager()->getStorage()->offsetExists($this->defaultUserId)){
        return false;
      }
          return true;
    }
    /**
     * Destroys user id session and returns the result of an operation.
     *
     * @param void
     * @return boolean
     */

    public  function logout()
    {
        if($this->getSessionManager()->getStorage()->offsetExists($this->defaultUserId))
        {
           $this->getSessionStorage()->offsetUnset($this->defaultUserId);
        }
        return true;
    }

    /**
     * Removes userdata based on an id.
     *
     * @param $userId int.
     * @return mixed boolean
     */

    public  function removeUser($userId)
    {
        return $this->getUserRepository()->dropById($userId);
    }

    /**
     * Get User Identity Session based on the key.
     * If key is null returns an array of user credentials.
     *
     * @param $keydata mixed
     * @return mixed
     */
    public function getUserIdentify($keydata = null)
    {
        $identity = null;

        if($this->is_identified())
        {
            if(!is_array($keydata) && $keydata !== null){
                $identity = $this->getSessionManager()->getStorage()->offsetGet($keydata);
            }elseif(is_array($keydata)){
                $identity = array_fill_keys($keydata,array());
                foreach($keydata as $d){
                    $identity[$d] = $this->getSessionManager()->getStorage()->offsetGet($d);
                }
            }elseif($keydata == null){
                $identity = array();
                foreach($this->availableData as $data){

                    $identity[$data] = $this->getSessionManager()->getStorage()->offsetGet($data);
                }
            }
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