<?php
/**
 * 
 * User: Windows
 * Date: 2/24/14
 * Time: 12:56 PM
 * 
 */

namespace Application\Service;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserFolderServiceFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return new UserFolderService($config['user_file_manager']);
    }


} 