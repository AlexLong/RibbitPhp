<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 1:15 PM
 * 
 */

namespace UserProfile\Domain\Concrete;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserAggregateFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {


        $db_adapter=  $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $userAggregate = new UserAggregate($db_adapter);
        return $userAggregate;
    }


} 