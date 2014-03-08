<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 12:45 PM
 * 
 */

namespace UserAuc\Service;


use UserAuc\Entity\AuthEntity;
use UserProfile\Domain\Concrete\ProfileQueryFactory;
use UserProfile\Domain\Concrete\UserAggregate;
use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use UserProfileEditor\Service\UserDirService;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\SessionManager;
use Zend\Session\Storage\SessionStorage;
use Zend\Stdlib\ArrayObject;


class AuthenticationService  implements  AuthenticationServiceInterface, ServiceLocatorAwareInterface {

    protected $userAggregate;

    protected $sessionManager;

    protected $serviceLocator;

    protected $defaultUserId  = 'id';

    protected $underDev = false;

    protected $queryFactory;

    protected $authEntity;

    protected $dirService;

    /**
     *
     * Creates a new user based on submitted data.
     *
     * @param array $postData
     * @param string $role
     * @return bool
     */
    public function signUp($postData)
    {
        $result = $this->getUserAggregate()->getUser()->createUser((array)$postData);
        $completed = false;
        if(!empty($result)){
          $completed = $this->getUserAggregate()->getProfile()
                                  ->createProfile(array('user_id' => $result['id']));
          if($completed){
              $completed = $this->authenticate($postData);
              if($completed){
                $this->getDirService()->createProfileDir($result['id']);
              }
          }
        }

        return $completed;
    }
    /**
     * Authenticates user based on submitted data.
     *
     * @param $postData array
     * @return bool
     */
    public function authenticate($postData)
    {
        $result = $this->getQueryFactory()->resolveUserByEmail($postData['email']);
       if($result['password'] != md5($postData['password'])) return false;
            $entity = $this->getAuthEntity()->ExchangeArray($result)->getFields();
            foreach($entity as $key=>$value){
                $this->getSessionManager()->getStorage()->offsetSet($key,$value);
            }
            if(isset($postData['remember_me']) && $postData['remember_me'] == true && !$this->underDev){
                $this->getSessionManager()->rememberMe();
            }
      return true;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function updateUserSession($data = array()){
       // var_dump($data);
        foreach($data as $key=>$value){
            $this->getSessionStorage()->offsetSet($key,$value);
        }
        return $this;
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
        if($this->getSessionStorage()->offsetExists($this->defaultUserId))
        {
           $this->getSessionStorage()->clear();
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
        return $this->getUserAggregate()->getUser()->dropById($userId);
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
            if(is_string($keydata)){
                $identity = $this->getSessionStorage()->offsetGet($keydata);
               // var_dump($identity);
            }elseif(is_array($keydata)){
                $identity = array_fill_keys($keydata,array());
                foreach($keydata as $s){
                    $identity[$s] = $this->getSessionStorage()->offsetGet($s);
                }
            }else{
                $fields = $this->getAuthEntity()->getFields();
                $identity = array_fill_keys($fields,array());
                foreach($fields as $key=>$val){
                    $identity[$key] = $this->getSessionManager()->getStorage()->offsetGet($key);
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

    /**
     * @return SessionStorage
     */

    public function getSessionStorage()
    {
        return $this->getSessionManager()->getStorage();
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

    /**
     * @return UserAggregate
     */
    public function getUserAggregate()
    {
        if(!$this->userAggregate){
            $this->userAggregate =  $this->getServiceLocator()->get('userAggregate');
        }
        return $this->userAggregate;
    }

    /**
     * @return ProfileQueryFactory
     */
    public function getQueryFactory()
    {
        if(!$this->queryFactory){
            $this->queryFactory = new ProfileQueryFactory($this->getUserAggregate());
        }
        return $this->queryFactory;
    }

    /**
     * @param mixed AuthEntity
     */
    public function setAuthEntity($authEntity)
    {
        $this->authEntity = $authEntity;
    }

    /**
     * @return AuthEntity
     */
    public function getAuthEntity()
    {
        return $this->authEntity;
    }

    /**
     * @param mixed UserDirService
     */
    public function setDirService($dirService)
    {
        $this->dirService = $dirService;
    }

    /**
     * @return UserDirService
     */
    public function getDirService()
    {
        return $this->dirService;
    }








} 