<?php
/**
 * 
 * User: Windows
 * Date: 1/19/14
 * Time: 6:38 PM
 * 
 */



namespace ApplicationTest;

use Application\Form\LoginForm;
use Application\Service\User\AuthenticationService;
use ApplicationTest\Bootstrap;
use Zend\Db\Adapter\Adapter;
use Zend\Dom\Query;
use Zend\Mvc\ResponseSender\HttpResponseSender;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;
use Zend\Session\SessionManager;
use Zend\Stdlib\Parameters;
use Zend\Validator\Csrf;

class IndexControllerTest  extends  PHPUnit_Framework_TestCase {

    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;
    protected $adapter;
    protected $authService;
    protected $sessionManager;
    protected $storage;


    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();

        $this->controller = new IndexController();
      //  $this->controller->getResponse()

        $this->request    = new Request();


        $this->sessionManager = $serviceManager->get('Zend\Session\SessionManager');
        $this->storage = $this->sessionManager->getStorage();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event      = new MvcEvent();

        $this->response = new Response();




        $this->authService = $serviceManager->get('AuthService');

        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);



        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);




        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);






        $this->controller->getRequest();

    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse()->getStatusCode();

        $this->assertEquals(200,$response);
    }

   public  function testLoginActionCanBeAccessed()
   {
       $this->routeMatch->setParam('action','login');

       $this->controller->dispatch($this->request);


       $response = $this->controller->getResponse()->getStatusCode();

       $this->assertEquals(200,$response);
   }

    public  function  testCanBeAccountSuccessfullyLogged()
    {


        $params = new Parameters(array('email' => 'test@test.com',
            'password' => 'secret', 'remember_me' => 1, 'auth_token' => 'dd'));


        $this->request->setPost($params)
            ->setMethod('Post');

        $this->routeMatch->setParam('action','login');
        $this->controller->dispatch($this->request);


       // $response = $this->controller->getResponse()->getStatusCode();
        //$this->assertEquals(302,$response );

    }





} 