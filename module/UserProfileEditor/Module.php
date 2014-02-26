<?php
namespace UserProfileEditor;

use UserProfileEditor\Form\ProfileForm;
use UserProfileEditor\Form\ProfileFormModel;
use Zend\Config\Config;
use Zend\Mvc\MvcEvent;


class Module
{
    public function getConfig()
    {
        $conf = array_merge_recursive(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/routes.config.php',
            include __DIR__ . '/config/template.config.php'
        );
        return new Config($conf);
    }

    public function onBootstrap(MvcEvent $e){

      //  $sharedManager = $e->getEventManager()->getSharedEventManager();
    }
    public function getViewHelperConfig()
    {

        return array(
            'invokables' => array(
                'editFormErrors' => 'UserProfileEditor\ViewHelper\EditFormErrors',
                'profileImgResolver' => 'UserProfileEditor\ViewHelper\UserImgResolver'
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
                'userDirManager' => 'UserProfileEditor\Service\UserDirServiceFactory',

                 'profileEditForm' => function($sm){
                  $profile_form = new ProfileForm();
                  $profileModel = new ProfileFormModel();
                  $profileModel->setUserAuc($sm->get('AuthService'));
                  $profileModel->setDirService($sm->get('userDirManager'));
                  $profile_form->setInputFilter($profileModel->getInputFilter());
                  return $profile_form;
                  }

            )
        );
    }
}
