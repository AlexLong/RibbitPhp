<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Domain\DbLayerConcrete\GeneralRepository;
use Application\Domain\DbLayerConcrete\UserRepository;
use Application\Domain\Entity\RibbitUser;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use Zend\Db\Sql\Sql;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\SessionManager;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        return new ViewModel();
    }

    public function loginAction()
    {


        return new ViewModel();
    }

    public function getAuthService()
    {
        return  $authService = $this->serviceLocator->get('AuthService');
    }




}
