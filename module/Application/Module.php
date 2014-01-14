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
use Application\Service\User\AuthenticationService;
use Composer\Console\Application;
use Zend\Db\Sql\Sql;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Session\SessionManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        /*
        $eventManager->attach(MvcEvent::EVENT_DISPATCH,function($e){

            $appl = $e->getRouteMatch();
            $params = $appl->getParams();
            var_dump($params['action']);
        },50);
        */
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
        return include __DIR__ . '/config/module.config.php';
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
                'renderForm' => 'Application\ViewHelpers\Form\RenderFormHelper'
            )
        );
    }


    public  function  getServiceConfig()
    {
        return array(
            'invokables' => array(
            ),
           'factories' => array(




            'AuthService' => function($sm){
               $user_repository = $sm->get('RepositoryAccessor')->users;

               $sessionManager = $sm->get('Zend\Session\SessionManager');

               $loginForm = new \Application\Form\LoginForm();
               $loginModel = new \Application\Model\LoginModel();
               $authService = new AuthenticationService();
               $authService->setSessionManager($sessionManager);
               $authService->setLoginForm($loginForm);
               $authService->setLoginModel($loginModel);
               $authService->setUserRepository($user_repository);
               return $authService;
            },


           'RepositoryAccessor' => function($sm){
               $general_repository = $sm->get('GeneralRepository');
               $repository_accessor = new RepositoryAccessor($general_repository);
               return $repository_accessor;
           } ,



         'GeneralRepository' => function($sm){
                 $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                 $sql = new Sql($dbAdapter);
                 $repository  = new GeneralRepository();
                 $repository->setSqlManager($sql);
                 $repository->setDbAdapter($dbAdapter);
                 $repository->setEntityManager('doctrine.entitymanager.orm_default');
                 $repository->setServiceLocator($sm);
                 return $repository;
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
