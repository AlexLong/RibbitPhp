<?php
/**
 * 
 * User: Windows
 * Date: 1/17/14
 * Time: 9:06 PM
 * 
 */

namespace UserAuc\ViewHelpers;

use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use Zend\View\Helper\AbstractHelper;

class UserIdentity extends  AbstractHelper {

    protected $authService;
    protected $identity;

    function __invoke($key = null)
    {


        if($key){
            return $this->getIdentity($key);
        }
        return $this;
    }
    public  function isLogged()
    {
        return $this->getAuthService()->is_identified();
    }

    public function getIdentity($key = null)
    {
        return $this->getAuthService()->getUserIdentify($key);
    }
    //public  function
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





} 