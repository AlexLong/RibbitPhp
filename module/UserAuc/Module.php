<?php
namespace UserAuc;

use UserAuc\Form\LoginForm;
use UserAuc\Form\SignForm;
use UserAuc\Form\Validator\EmailExists;
use UserAuc\Form\Validator\UsernameExists;
use UserAuc\Model\LoginModel;
use UserAuc\Model\SignModel;
use UserAuc\ViewHelpers\Form\RenderFormHelper;
use Zend\Config\Config;

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

    public function getViewHelperConfig()
    {

        return array(
            'invokables' => array(

            ),
            'factories' => array(
                'UserIdentity' => 'UserAuc\ViewHelpers\Service\UserIdentityFactory',
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
                'AuthService' => 'UserAuc\Service\AuthenticationServiceFactory',
                'SignForm' => function($sm){
                        $signForm = new SignForm();
                        $signModel = new SignModel();
                        $emailExistValidator = new EmailExists();
                        $usernameExistsValidator = new UsernameExists();
                        $usernameExistsValidator->setUserTable($sm->get('userAggregate')->getUser());
                        $emailExistValidator->setUserTable($sm->get('userAggregate')->getUser());
                        $signModel->setEmailValidator($emailExistValidator);
                        $signModel->setUsernameValidator($usernameExistsValidator);
                        $signForm->setInputFilter($signModel->getInputFilter());
                        return $signForm;
                    },

                'LoginForm' => function($sm){
                        $loginForm = new LoginForm();
                        $loginModel = new LoginModel();
                        $emailExistValidator = new EmailExists(array('login' => true));
                        $emailExistValidator->setUserTable($sm->get('userAggregate')->getUser());
                        $loginModel->setEmailValidator($emailExistValidator);
                        $loginForm->setInputFilter($loginModel->getInputFilter());
                        return $loginForm;

               },
            ),
        );
    }
}
