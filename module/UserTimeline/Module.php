<?php
namespace UserTimeline;

use Zend\Config\Config;

class Module
{
    public function getConfig()
    {
        $conf = array_merge(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/template.config.php'
        );

        return new Config($conf);
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
