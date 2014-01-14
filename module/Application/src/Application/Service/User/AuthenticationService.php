<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 12:45 PM
 * 
 */

namespace Application\Service\Interfaces\User;


use Application\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Application\Model\LoginModel;
use UserAuth\Form\LoginForm;
use Zend\Session\SessionManager;

class AuthenticationService implements  AuthenticationServiceInterface {

    protected $user_repository;

    protected $sessionManager;

    protected $loginForm;

    protected $loginModel;

    //protected $formData = array();



    public function  authenticate($postData)
    {
        // TODO: Implement authenticate() method.
    }

    function is_logged()
    {
        // TODO: Implement is_logged() method.
    }


    /**
     * @param mixed $loginForm
     */
    public function setLoginForm(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }

    /**
     * @return mixed
     */
    public function getLoginForm()
    {
        return $this->loginForm;
    }

    /**
     * @param mixed $loginModel
     */
    public function setLoginModel(LoginModel $loginModel)
    {
        $this->loginModel = $loginModel;
    }

    /**
     * @return mixed
     */
    public function getLoginModel()
    {
        return $this->loginModel;
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
     * @param mixed $user_repository
     */
    public function setUserRepository(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * @return mixed
     */
    public function getUserRepository()
    {
        return $this->user_repository;
    }





} 