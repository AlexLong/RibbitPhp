<?php
/**
 * 
 * User: Windows
 * Date: 1/13/14
 * Time: 2:58 PM
 * 
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class AbstractBaseController extends AbstractActionController
{

    public function getAuthService()
    {
        return  $authService = $this->serviceLocator->get('AuthService');
    }




} 