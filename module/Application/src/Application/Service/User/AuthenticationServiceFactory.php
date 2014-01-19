<?php
/**
 * 
 * User: Windows
 * Date: 1/19/14
 * Time: 1:54 PM
 * 
 */

namespace Application\Service\User;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthenticationServiceFactory implements   FactoryInterface {
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $authService = new AuthenticationService();

        $user_repository = $serviceLocator->get('RepositoryAccessor')->users;
        $sessionManager = $serviceLocator->get('Zend\Session\SessionManager');

        $loginForm = new \Application\Form\LoginForm();
        $loginModel = new \Application\Model\LoginModel();

        $authService->setSessionManager($sessionManager);
        $authService->setLoginForm($loginForm);
        $authService->setLoginModel($loginModel);
        $authService->setUserRepository($user_repository);

        return $authService;
    }


} 