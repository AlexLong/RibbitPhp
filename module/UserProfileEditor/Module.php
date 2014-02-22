<?php
namespace UserProfileEditor;

use UserProfileEditor\Form\ProfileForm;
use Zend\Config\Config;


class Module
{
    public function getConfig()
    {
        $conf = array_merge(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/routes.config.php',
            include __DIR__ . '/config/template.config.php'
        );
        return new Config($conf);
    }
    public function getViewHelperConfig()
    {

        return array(
            'invokables' => array(

            ),
            'factories' => array(


            ),
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

    public  function  getServiceConfig(){
        return array(
            'invokables' => array(

            ),
            'factories' => array(

                'EditProfileForm' => function($sm){


                 }
            )
        );
    }
}
