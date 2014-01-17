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
        if (!$this->authService instanceof AuthenticationServiceInterface) {
            throw new \Exception('No AuthenticationService instance provided');
        }

        if (!$this->authService->hasIdentity()) {
            return null;
        }

        return $this->authService->getIdentity();
    }

    /**
     * @param mixed $authService
     */
    public function setAuthService($authService)
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