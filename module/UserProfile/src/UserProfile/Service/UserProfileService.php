<?php
/**
 * 
 * User: Windows
 * Date: 2/7/14
 * Time: 8:16 PM
 * 
 */

namespace UserProfile\Service;


use UserProfile\Domain\DbLayerConcrete\ProfileQueryFactory;
use UserProfile\Domain\DbLayerConcrete\UserAggregate;
use UserProfile\Service\Interfaces\UserProfileServiceInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class UserProfileService implements ServiceLocatorAwareInterface, UserProfileServiceInterface{


    protected $serviceLocator;

    protected $profileCacheService;

    protected $userProfile;

    protected $userRepository;

    protected $queryFactory;

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
    public function isProfileOwner($user_id){
     $owner = false;
     $auth_service =  $this->getServiceLocator()->get('AuthService');
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
     * @param mixed $globalCacheService
     */
    public function setProfileCacheService($profileCacheService)
    {
        $this->profileCacheService = $profileCacheService;
    }

    /**
     * @return mixed
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




} 