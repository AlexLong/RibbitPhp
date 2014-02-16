<?php

namespace UserProfile\Service;


use Application\Service\AbstractCacheService;
use UserProfile\Service\Interfaces\UserProfileCacheServiceInterface;
use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserProfileCacheService extends  AbstractCacheService implements ServiceLocatorAwareInterface, UserProfileCacheServiceInterface {

    protected $serviceLocator;

    function setUserProfile($username,$value)
    {
        $key = $this->formatKey($username);
        $this->getCacheService()->setItem($key, $value);
    }
    /**
     * @param string $username
     * @return array
     */
    function getUserProfile($username)
    {
       $key = $this->formatKey($username);
       return $this->getCacheService()->getItem($key);
    }

    /**
     * @param string $username
     * @return boolean
     */
    function removeUserProfile($username)
    {
        $key = $this->formatKey($username);
        return $this->getCacheService()->removeItem($key);
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
        $this->serviceLocator;
    }


} 