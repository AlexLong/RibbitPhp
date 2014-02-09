<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;


use Application\Domain\Entity\RibbitUser;

use Application\Form\LoginForm;
use Zend\Json\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractBaseController
{

   public function indexAction()
   {

      // $this->getResponse()->

       /*
       $request = $this->getEvent()->getRouteMatch()->getParams();
       var_dump(isset($request['user']) ? $request['user'] : '');
       */

        return new ViewModel();
   }
    public function userAction(){

        $request = $this->getEvent()->getRouteMatch()->getParams();
        var_dump(isset($request['user']) ? $request['user'] : '');

        $user = $this->serviceLocator->get('UserService')->getUserProfileByUsername($request['user']);
        var_dump($user);
        throw new \Exception("Not Implemented ");

    }
}
