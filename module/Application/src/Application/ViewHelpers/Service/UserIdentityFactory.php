<?php
/**
 * 
 * User: Windows
 * Date: 1/19/14
 * Time: 10:35 AM
 * 
 */

namespace Application\ViewHelpers\Service;


use Application\ViewHelpers\User\UserIdentity;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserIdentityFactory implements FactoryInterface{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();
        $helper = new UserIdentity();
        if($services->has('AuthService')){
            $helper->setAuthService($services->get('AuthService'));
        }
        return $helper;
     }


} 