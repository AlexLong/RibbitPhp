<?php
/**
 * 
 * User: Windows
 * Date: 1/17/14
 * Time: 9:06 PM
 * 
 */

namespace Application\ViewHelpers\User;


use Application\Service\Interfaces\User\AuthenticationServiceInterface;
use Zend\View\Helper\AbstractHelper;

class UserIdentity extends  AbstractHelper {


    protected $authService;

    function __invoke()
    {
        return $this;
    }

    public  function isLogged()
    {
        return $this->getAuthService()->is_identified();
    }
    //public  function


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





} 