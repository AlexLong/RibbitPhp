<?php
/**
 * 
 * User: Windows
 * Date: 1/13/14
 * Time: 2:58 PM
 * 
 */

namespace UserProfile\Controller;


use UserAuc\Service\AuthenticationService;
use UserProfile\Controller\Plugin\UserPlugin;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

class AbstractUserController extends AbstractActionController
{

   protected   $userPlugin;

    protected  $config;

    /**
     * @return AuthenticationService
     */

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

    public function getUserPlugin()
    {

        if(!$this->userPlugin)
        {
            $this->setUserPlugin(new UserPlugin());
        }
        return $this->userPlugin;
    }

    public function getCurrentUri()
    {
        return $this->getRequest()->getUriString();
    }

    public function setUserPlugin(UserPlugin $userPlugin)
    {
        $user_links = $this->getConfig();
        $this->userPlugin = $userPlugin;
        $this->userPlugin->setAuthService($this->getAuthService());
        $this->userPlugin->setRedirect($this->redirect());
        $this->userPlugin->setEvent($this->getEvent());
        $this->userPlugin->setUserLinks($user_links['user_links']);
        $this->userPlugin->setSessionManager($this->getSessionManager());
        $this->userPlugin->setRequest($this->getRequest());
    }



    public  function  getRequestParams()
    {
        return  $this->getEvent()->getParams();
    }
    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        if(!$this->config)
        {
            $this->setConfig($this->getServiceLocator()->get('config'));
        }
        return $this->config;
    }

} 