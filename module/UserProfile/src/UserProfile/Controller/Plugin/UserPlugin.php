<?php
/**
 * 
 * User: Windows
 * Date: 1/15/14
 * Time: 8:35 PM
 * 
 */

namespace UserProfile\Controller\Plugin;


use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use Zend\Http\Request;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Controller\Plugin\Redirect;
use Zend\Session\SessionManager;
use Zend\Uri\Uri;
use Zend\View\Helper\ViewModel;

class UserPlugin extends AbstractPlugin  {

    protected $redirect;

    protected $event;

    protected $authService;

    protected $userLinks;

    protected $sessionManager;

    protected $request;

    protected $route;

    protected $return_uri = 'return_uri';


    public  function requireAuth()
    {

        if(!$this->getAuthService()->is_identified()){
            $this->generateReturnUri($this->getRequest()->getUriString());
            return $this->redirectToAuth();
        }

        return false;
    }

    public function postOnly()
    {
        if(!$this->getRequest()->isPost()){
            return new ViewModel();
        }
        return true;
    }

    public function redirectToAuth()
    {
        return $this->configureRedirectByLink('login_form');
    }

    public  function redirectToIndex()
    {
        return $this->configureRedirectByLink('index');
    }
    public function validateReturnUri($return_uri)
    {
        $uri = new Uri($return_uri);
        $current_host = $this->getRequest()->getUri()->getHost();

        if(!$uri->isValid() || $uri->getHost() != $current_host)
            return false;

        return true;
    }
    public  function  generateReturnUri($return_uri = null)
    {
        if($return_uri != null && $this->validateReturnUri($return_uri) == true)
        {
            $this->getSessionManager()->getStorage()->offsetSet($this->return_uri,$return_uri);

            return $this;
        }
        return $this;
    }

    public function hasReturnUri()
    {
        return $this->getSessionManager()->getStorage()->offsetExists($this->return_uri);
    }

    public  function getReturnUri()
    {
        return $this->getSessionManager()->getStorage()->offsetGet($this->return_uri);
    }

    public function destroyReturnUri()
    {

        if($this->getSessionManager()->getStorage()->offsetExists($this->return_uri)){

            $this->getSessionManager()->getStorage()->offsetUnset($this->return_uri);
        }
        return $this;
    }
    public  function redirectToReturnUri()
    {
        $rt = $this->getReturnUri();
        $this->destroyReturnUri();
        return $this->getRedirect()->toUrl($rt);
    }
    public  function signedUserRedirect()
    {
        if($this->getAuthService()->is_identified()){
            return $this->redirectToHome();
        }
        return false;
    }
    public  function  redirectToHome(){
        return $this->configureRedirectByLink('user_home');
    }



    public function configureRedirectByLink($user_link, $query = null )
    {
        $links = $this->getUserLinks();

        $chosen_link = $links[$user_link];
        return ($this->getRedirect()->toRoute($chosen_link['route'],
            array('action' => $chosen_link['action']), array('query' =>
                $query)));
    }
    public function setRedirect(Redirect $redirect)
    {
        if(null == $this->redirect )
            $this->redirect = $redirect;
       $this->redirect = $redirect;
    }




    protected function getRedirect()
    {

        return $this->redirect;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }



    /**
     * @param mixed $authService
     */
    public function setAuthService(AuthenticationServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @return mixed
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * @param mixed $userLinks
     */
    public function setUserLinks($userLinks)
    {
        $this->userLinks = $userLinks;
    }

    /**
     * @return mixed
     */
    public function getUserLinks()
    {
        return $this->userLinks;
    }

    /**
     * @param mixed $sessionManager
     */
    public function setSessionManager(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    /**
     * @return mixed
     */
    public function getSessionManager()
    {

        return $this->sessionManager;
    }

    /**
     * @param mixed $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

} 