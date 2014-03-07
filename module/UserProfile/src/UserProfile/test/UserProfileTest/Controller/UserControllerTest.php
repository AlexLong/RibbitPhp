<?php
/**
 * 
 * User: Windows
 * Date: 1/19/14
 * Time: 6:38 PM
 * 
 */



namespace UserProfileTest;

use UserProfile\Controller\UserAucController;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;
use Zend\Stdlib\Parameters;


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
    protected $serviceManager;
    protected $userTable;

    protected $mock_user;


    protected function setUp()
    {
       $this->serviceManager = Bootstrap::getServiceManager();

        $this->controller = new UserAucController();

        $this->request    = new Request();

        $this->adapter = $this->serviceManager->get('Zend\Db\Adapter\Adapter');
       // $this->userTable = $this->serviceManager->get('userAggregate')->getUser();

        $this->sessionManager = $this->serviceManager->get('Zend\Session\SessionManager');
        $this->storage = $this->sessionManager->getStorage();

        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event      = new MvcEvent();

        $this->response = new Response();

        $this->mock_user = array('email' => 'test@test.com',
            'username' => 'test', 'password' => 'secret');

        $this->authService = $this->serviceManager->get('AuthService');

        $config = $this->serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);
        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);

        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->serviceManager);

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

      $id =  $this->serviceManager->get('UserTable')->findByEmail($params['email'], array('id'));

        if(!$id){
            $this->authService->signUp($this->mock_user);
        }

        $this->request->setPost($params)
            ->setMethod('Post');
        $this->routeMatch->setParam('action','login');
        $this->controller->dispatch($this->request);
        
        $expected = 302;
        
        $actual = $this->controller->getResponse()->getStatusCode();
        
        $this->assertEquals($expected, $actual);
    }
    /************* Sign Form ************/


    public function testCanBeSignPageAccessed()
    {
        $this->routeMatch->setParam('action', 'sign');
        $this->controller->dispatch($this->request);
        $expected = 200;
        $actual = $this->controller->getResponse()->getStatusCode();
        $this->assertEquals($expected, $actual);

    }
    public function testCanUserSignUp()
    {
        $params = new Parameters(array('email' => 'test@test.com','username' => 'test',
            'password' => 'secret', 'remember_me' => 1, 'auth_token' => 'dd'));

       $result = $this->serviceManager->get('userAggregate')->getUser()->findByUsername($params['username'],array('id'));
        if($result){
            $this->serviceManager->get('userAggregate')->getUser()->dropById($result['id']);
        }
        $this->request->setPost($params)
            ->setMethod('Post');
       $this->routeMatch->setParam('action', 'sign');
       $this->controller->dispatch($this->request);

       $this->assertEquals(302,$this->controller->getResponse()->getStatusCode());
    //  var_dump($this->serviceManager->get('SignForm')->getMessages());
    }

    public function testCanGetAMockProfile(){


  // $user_profile = $this->serviceManager->get('UserProfileService')->getUserProfileByUsername('test');
      // $user_profile = $this->serviceManager->get('userAggregate')->getProfile();
       // var_dump($user_profile->getUserProfileByUsername('test'));
       // $user_profile = new UserProfile($this->serviceManager);
  //  $this->assertNotNull($user_profile);

    }



} 