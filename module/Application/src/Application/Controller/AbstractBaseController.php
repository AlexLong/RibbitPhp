<?php
/**
 * 
 * User: Windows
 * Date: 1/13/14
 * Time: 2:58 PM
 * 
 */

namespace Application\Controller;


use Application\Controller\Plugin\UserPlugin;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

class AbstractBaseController extends AbstractActionController
{

   protected   $userPlugin;



    public function onDispatch(MvcEvent $e)
    {
        parent::onDispatch($e);




      //  $this->setUserPlugin(new UserPlugin());

       // echo "Dispatched !!!!!";

    }

    public function getAuthService()
    {
        return $this->serviceLocator->get('AuthService');
    }

    public function getSessionManager()
    {
        return $this->serviceLocator->get('Zend\Session\SessionManager');
    }

    public function getSessionStorage()
    {

        return $this->getSessionManager()->getStorage();
    }

    public function  getUserPlugin()
    {

        if($this->userPlugin == null){
            $userPlugin = new UserPlugin();
            $userPlugin->setAuthService($this->getAuthService());
            $userPlugin->setRedirect($this->redirect());
            $userPlugin->setEvent($this->getEvent());
            $this->userPlugin = $userPlugin;
        }
        return $this->userPlugin;
    }

    /*
    public function setUserPlugin(UserPlugin $userPlugin)
    {
        if($this->userPlugin == null){
            $userPlugin->setAuthService($this->getAuthService());
            $userPlugin->setRedirect($this->redirect());
            $userPlugin->setEvent($this->getEvent());
            $this->userPlugin = $userPlugin;
        }
    }
    */



} 