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

    protected   $config;



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

        if(!$this->userPlugin)
        {
            $this->setUserPlugin(new UserPlugin());

        }
        return $this->userPlugin;
    }


    public function setUserPlugin(UserPlugin $userPlugin)
    {
        $user_links = $this->getConfig();

        $this->userPlugin = $userPlugin;
        $this->userPlugin->setAuthService($this->getAuthService());
        $this->userPlugin->setRedirect($this->redirect());
        $this->userPlugin->setEvent($this->getEvent());
        $this->userPlugin->setUserLinks($user_links['user_links']);
        unset($user_links);
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