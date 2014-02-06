<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Domain\DbLayerConcrete\GeneralRepository;
use Application\Domain\DbLayerConcrete\RepositoryAccessor;
use Application\Form\LoginForm;
use Application\Form\SignForm;
use Application\Form\Validator\EmailExists;
use Application\Form\Validator\UsernameExists;
use Application\Model\LoginModel;
use Application\Model\SignModel;
use Application\Service\User\AuthenticationService;
use Application\ViewHelpers\Form\RenderFormHelper;
use Composer\Console\Application;
use Zend\Config\Config;
use Zend\Db\Sql\Sql;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Session\Service\SessionManagerFactory;
use Zend\Session\SessionManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);


        $eventManager->attach(MvcEvent::EVENT_DISPATCH,function($e){

        },50);

        $this->bootstrapSession($e);
    }

    public  function  bootstrapSession($e)
    {
        $session = $e->getApplication()
                    ->getServiceManager()
                    ->get('Zend\Session\SessionManager');

        $session->start();

        $container = new Container('initialized');
        if(!isset($container->init)){
            $session->regenerateId(true);
            $container->init = 1;
        }

    }

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
                'renderForm' => function($sm){
                  $locator = $sm->getServiceLocator();
                  $helper = new RenderFormHelper();
                  $helper->setSignForm($locator->get('SignForm'));
                        $helper->setLoginForm($locator->get('LoginForm'));
                  return $helper;
                },

                'UserIdentity' => 'Application\ViewHelpers\Service\UserIdentityFactory',



            ),


        );
    }


    public  function  getServiceConfig()
    {
        return array(
            'invokables' => array(

            ),
           'factories' => array(

            'AuthService' => 'Application\Service\User\AuthenticationServiceFactory',
               'SignForm' => function($sm){
                       $signForm = new SignForm();
                       $signModel = new SignModel();

                       $emailExistValidator = new EmailExists();
                       $usernameExistsValidator = new UsernameExists();
                       $usernameExistsValidator->setUserRepository($sm->get('RepositoryAccessor')->get('users'));
                       $emailExistValidator->setUserRepository($sm->get('RepositoryAccessor')->get('users'));
                       $signModel->setEmailValidator($emailExistValidator);
                       $signModel->setUsernameValidator($usernameExistsValidator);

                       $signForm->setInputFilter($signModel->getInputFilter());
                       return $signForm;
                   },

               'LoginForm' => function($sm){
                       $loginForm = new LoginForm();
                       $loginModel = new LoginModel();
                       $emailExistValidator = new EmailExists(array('login' => true));
                       $emailExistValidator->setUserRepository($sm->get('RepositoryAccessor')->get('users'));
                       $loginModel->setEmailValidator($emailExistValidator);
                       $loginForm->setInputFilter($loginModel->getInputFilter());

                       return $loginForm;

                 },
           'RepositoryAccessor' => function($sm){
               $repository_accessor = new RepositoryAccessor();
                $repository_accessor->setServiceLocator($sm);
               return $repository_accessor;
           },

               'Zend\Session\SessionManager' => function ($sm) {

                       $config = $sm->get('config');
                       if (isset($config['session'])) {
                           $session = $config['session'];

                           $sessionConfig = null;
                           if (isset($session['config'])) {
                               $class = isset($session['config']['class'])  ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                               $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                               $sessionConfig = new $class();
                               $sessionConfig->setOptions($options);
                           }

                           $sessionStorage = null;
                           if (isset($session['storage'])) {
                               $class = $session['storage'];
                               $sessionStorage = new $class();
                           }

                           $sessionSaveHandler = null;
                           if (isset($session['save_handler'])) {
                               // class should be fetched from service manager since it will require constructor arguments
                               $sessionSaveHandler = $sm->get($session['save_handler']);
                           }

                           $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

                           if (isset($session['validators'])) {
                               $chain = $sessionManager->getValidatorChain();
                               foreach ($session['validators'] as $validator) {
                                   $validator = new $validator();
                                   $chain->attach('session.validate', array($validator, 'isValid'));

                               }
                           }
                       } else {
                           $sessionManager = new SessionManager();
                       }
                       Container::setDefaultManager($sessionManager);
                       return $sessionManager;
                   },
           )
        );

    }
}
