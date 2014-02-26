<?php
/**
 * 
 * User: Windows
 * Date: 2/26/14
 * Time: 2:46 PM
 * 
 */

namespace Application\Service;


use Application\Strategy\StrategyRenderer\ImageRenderer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ImageRendererFactory implements FactoryInterface {
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $imageRenderer = new ImageRenderer();
        return $imageRenderer;
    }


} 