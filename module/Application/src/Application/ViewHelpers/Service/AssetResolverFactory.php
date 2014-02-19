<?php
/**
 * 
 * User: Windows
 * Date: 2/19/14
 * Time: 7:05 PM
 * 
 */

namespace Application\ViewHelpers\Service;


use Application\ViewHelpers\AssetResolver;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AssetResolverFactory implements FactoryInterface {



    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $services = $serviceLocator->getServiceLocator();

        $config = $services->get("Config");

        $helper = new AssetResolver();
        $helper->setAssetDirectory(isset($config['asset_resolver']['asset_directory']) ? $config['asset_resolver']['asset_directory'] : array() );

        return $helper;

    }

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        // TODO: Implement detach() method.
    }


}