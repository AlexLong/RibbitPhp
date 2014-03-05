<?php
namespace UserProfileEditor;

use UserProfileEditor\Form\PictureForm;
use UserProfileEditor\Form\PictureModel;
use UserProfileEditor\Form\ProfileForm;
use UserProfileEditor\Form\ProfileFormModel;
use UserProfileEditor\ViewHelper\UserImgResolver;
use Zend\Config\Config;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;


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
                'img' => 'UserProfileEditor\ViewHelper\UserImgResolver'
            ),
            'factories' => array(
                'profileImg' => function($sm){
                        $locator = $sm->getServiceLocator();
                        $resolver = new UserImgResolver();
                        $resolver->setAuthService($locator->get('AuthService'));
                        $resolver->setUserAggregate($locator->get('userAggregate'));
                return $resolver;
                }
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

                'pictureEditForm' => function($sm){
                   $picture_form = new PictureForm();
                    $picture_model = new PictureModel();
                    $picture_model->setDirService($sm->get('userDirManager'));
                    $picture_model->setUserAuc($sm->get('AuthService'));
                    $picture_form->setInputFilter($picture_model->getInputFilter());

                    return $picture_form;
                 },

                 'profileEditForm' => function($sm){
                  $profile_form = new ProfileForm();
                  $profileModel = new ProfileFormModel();
                  $profile_form->setInputFilter($profileModel->getInputFilter());
                  return $profile_form;
                  }

            )
        );
    }
}
