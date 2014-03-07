<?php
/**
 * 
 * User: Windows
 * Date: 2/26/14
 * Time: 1:21 PM
 * 
 */

namespace Application\Service;


use Application\Strategy\ImageStrategy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ImageFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $imageRenderer = $serviceLocator->get('ImageRenderer');

        return new ImageStrategy($imageRenderer);
    }

} 