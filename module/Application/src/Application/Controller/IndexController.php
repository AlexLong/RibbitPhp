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
use Application\Form\LoginForm;
use Application\Model\LoginModel;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use Zend\Db\Sql\Sql;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\Redirect;
use Zend\Session\SessionManager;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractBaseController
{

    protected  $userHome = 'user_home';

   public function indexAction()
   {
       $this->getUserPlugin()->requireAuth();

        return new ViewModel();
   }

    public function loginAction()
    {

        $logged = $this->getAuthService()->is_identified();

       // $reoute = $this->getEvent()->

        if($logged)
            return $this->forward()->dispatch('Application\Controller\Home',array('action' =>'index'));

        if($this->getRequest()->isPost() && !$logged){

            $data = $this->getRequest()->getPost();

            if(!$this->getAuthService()->authenticate($data))
            {
                $messages = $this->getAuthService()->getValidationMessages();

                return new ViewModel(array('validation_messages' => $messages));
            }
            return  $this->redirect($this->userHome);
        }
       return new ViewModel();
    }



}
