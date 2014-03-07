<?php
namespace UserTimeline;

use Zend\Config\Config;
use Zend\ModuleManager\ModuleEvent;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\ArrayObject;

class Module
{

    protected  $someData = array();
    public function getConfig()
    {
        $conf = array_merge_recursive(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/routes.config.php',
            include __DIR__ . '/config/template.config.php'

        );

        return new Config($conf);
    }


    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();




    }

    public function getViewHelperConfig(){

        return array(
            'invokables' => array(
                'ShareMoodForm' => 'UserTimeline\ViewHelpers\ShareMoodHelper'
            ),

            'factories' => array(

            )
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
