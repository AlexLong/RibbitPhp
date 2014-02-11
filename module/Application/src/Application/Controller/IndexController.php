<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;


use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Server\Cache;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

   public function indexAction()
   {
        return new ViewModel();
   }
    public function userAction(){
        $user = $this->getEvent()->getRouteMatch()->getParam('user');
        $userService =  $this->getServiceLocator()->get('UserService');

       $result = $userService->getUserProfile($user);


        if($result){
           return new ViewModel(array('user' => $result));
       }

        return $this->notFoundAction();



        //var_dump(isset($request['user']) ? $request['user'] : '');

       // throw new \Exception("Not Implemented ");

    }
}
