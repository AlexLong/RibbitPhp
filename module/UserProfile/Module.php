<?php
namespace UserProfile;


use UserProfile\Form\LoginForm;
use UserProfile\Form\SignForm;
use UserProfile\Form\Validator\EmailExists;
use UserProfile\Form\Validator\UsernameExists;
use UserProfile\Model\LoginModel;
use UserProfile\Model\SignModel;
use UserProfile\Service\User\UserService;
use UserProfile\ViewHelpers\Form\RenderFormHelper;
use Zend\Config\Config;

class Module
{
    public function getConfig()
    {
        $conf = array_merge(
            include __DIR__ . '/config/template.config.php',
            include __DIR__ . '/config/module.config.php'
        );

        return new Config($conf);
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

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(

            ),
            'factories' => array(
                'UserIdentity' => 'UserProfile\ViewHelpers\Service\UserIdentityFactory',
                'renderForm' => function($sm){
                        $locator = $sm->getServiceLocator();
                        $helper = new RenderFormHelper();
                        $helper->setSignForm($locator->get('SignForm'));
                        $helper->setLoginForm($locator->get('LoginForm'));
                        return $helper;
                    },

            ),
        );
    }


    public  function  getServiceConfig(){
        return array(
            'invokables' => array(

            ),
            'factories' => array(
                'AuthService' => 'UserProfile\Service\AuthenticationServiceFactory',
                'CacheService' => 'Zend\Cache\Service\StorageCacheFactory',


                'SignForm' => function($sm){
                        $signForm = new SignForm();
                        $signModel = new SignModel();
                        $emailExistValidator = new EmailExists();
                        $usernameExistsValidator = new UsernameExists();
                        $usernameExistsValidator->setUserRepository($sm->get('user_repository'));
                        $emailExistValidator->setUserRepository($sm->get('user_repository'));
                        $signModel->setEmailValidator($emailExistValidator);
                        $signModel->setUsernameValidator($usernameExistsValidator);
                        $signForm->setInputFilter($signModel->getInputFilter());
                        return $signForm;
                    },

                'LoginForm' => function($sm){
                        $loginForm = new LoginForm();
                        $loginModel = new LoginModel();
                        $emailExistValidator = new EmailExists(array('login' => true));
                        $emailExistValidator->setUserRepository($sm->get('user_repository'));
                        $loginModel->setEmailValidator($emailExistValidator);
                        $loginForm->setInputFilter($loginModel->getInputFilter());
                        return $loginForm;

                    },


                'UserService' => function($sm){
                        $user_service = new UserService();
                        $user_service->setServiceLocator($sm);
                        return $user_service;
                 },
                'user_repository' => function($sm){
                    $rep = new \UserProfile\Domain\DbLayerConcrete\UserRepository($sm);
                    return $rep;
                 },
                'user_profile_repository' => function($sm){
                 $rep = new  \UserProfile\Domain\DbLayerConcrete\UserProfileRepository($sm);
                 return $rep;
                },
            )
        );
    }
}
