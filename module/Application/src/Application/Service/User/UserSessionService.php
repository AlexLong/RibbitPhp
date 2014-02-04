<?php
/**
 * 
 * User: Windows
 * Date: 2/4/14
 * Time: 6:44 PM
 * 
 */

namespace Application\Service\User;


use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\SessionManager;

class UserSession extends SessionManager implements ServiceLocatorAwareInterface{


    protected $serviceLocator;




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
        // TODO: Implement getServiceLocator() method.
    }


} 