<?php
/**
 * 
 * User: Windows
 * Date: 2/7/14
 * Time: 8:16 PM
 * 
 */

namespace UserProfile\Service;


use UserAuc\Service\AuthenticationService;
use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use UserProfile\Domain\DbLayerConcrete\ProfileQueryFactory;
use UserProfile\Domain\DbLayerConcrete\UserAggregate;
use UserProfile\Entity\UserProfile;
use UserProfile\Service\Interfaces\UserProfileServiceInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;


class UserProfileService implements ServiceLocatorAwareInterface, UserProfileServiceInterface{


    protected $serviceLocator;

    protected $profileCacheService;

    protected $userProfile;

    protected $userRepository;

    protected $queryFactory;

    protected $authService;

    function getUserProfile($username, $fromCache = true)
    {
        $result = null;

        if($fromCache){
         $result = $this->getProfileCacheService()->getUserProfile($username);
        }
       if(!$result){
          $id = $this->getUserAggregate()->getUser()->findByUsername($username,array('id'));
          if(!$id) return $result;
          $result = $this->getQueryFactory()->resolveUserProfile($username); // Resolving the complex query
          $this->getProfileCacheService()->setUserProfile($result); // Caching result
        }
        return  $result;
    }

    /**
     * @param array $profile_data
     * @return array
     */
    public function updateProfile(array $profile_data){

        if(empty($profile_data) ) return true;
        $auth = $this->getAuthService();

       $identity = $auth->getUserIdentify();
       $this->getUserAggregate()->getProfile()
           ->update($profile_data,array('user_id' => $identity['id']));
       $updated_data = $this->getUserAggregate()->getProfile()
                                            ->findByUserId($identity['id']);
      $auth->updateUserSession($updated_data);
      $cache_data = array_push($auth->getUserIdentify(),$auth->getUserIdentify('username'));
      $this->getProfileCacheService()->setUserProfile($cache_data);
      return $updated_data;
   }
    public function isProfileOwner($user_id){
     $owner = false;
     $auth_service = $this->getAuthService();
        if($user_id && $auth_service->is_identified()){
            $id =  $auth_service->getUserIdentify("id");
            if($id == $user_id) $owner = true;
        }
      return $owner;
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
     * @return UserAggregate
     */
    public function getUserAggregate(){

        return  $this->getServiceLocator()->get('userAggregate');
    }
    /**
     * @param mixed $profileCacheService
     */
    public function setProfileCacheService($profileCacheService)
    {
        $this->profileCacheService = $profileCacheService;
    }

    /**
     * @return ProfileCacheService
     */
    public function getProfileCacheService()
    {
        return $this->profileCacheService;
    }

    /**
     * @return mixed
     */
    public function getQueryFactory()
    {
        if(!$this->queryFactory){
            $this->queryFactory = new ProfileQueryFactory($this->getUserAggregate());
        }
        return $this->queryFactory;
    }

    /**
     * @param mixed AuthenticationServiceInterface
     */
    public function setAuthService(AuthenticationServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        if(!$this->authService){
            $this->setAuthService($this->getServiceLocator()->get('AuthService'));
        }
        return $this->authService;
    }




} 