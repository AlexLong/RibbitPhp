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

class AbstractBaseController extends AbstractActionController
{

   public  $userPlugin;

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
            $this->userPlugin = new UserPlugin();
            $this->userPlugin->setRedirect($this->redirect());
            return $this->userPlugin;
        }


        return $this->userPlugin;
    }



} 