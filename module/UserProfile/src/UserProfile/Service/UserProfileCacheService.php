<?php
/**
 * 
 * User: Windows
 * Date: 2/11/14
 * Time: 4:00 PM
 * 
 */

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
        $this->getCacheService()->setItem($this->getNamespace().strtolower($username), $value);
    }
    /**
     * @param string $username
     * @return array
     */
    function getUserProfile($username)
    {
       return $this->getCacheService()->getItem($this->getNamespace().strtolower($username));
    }

    /**
     * @param string $username
     * @return boolean
     */
    function removeUserProfile($username)
    {
        return $this->getCacheService()->removeItem($this->namespace.strtolower($username));
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