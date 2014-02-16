<?php
/**
 * 
 * User: Windows
 * Date: 2/13/14
 * Time: 10:56 PM
 * 
 */

namespace UserProfile\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UserRestController extends AbstractRestfulController{


    protected $userProfile;

    public function getList()
    {


       $user = $this->getEvent()->getRouteMatch()->getParam("user");
       $result = $this->getUserService()->getUserProfile($user);
       if(!$result){

          return new JsonModel(array('errors' => array("code" => 404, "message" => "user not found")));
       }

        return new JsonModel(
            $result
        );
    }
    public function get($user){

    }
    /**
     * @return mixed
     */
    public function getUserService()
    {
        return $this->getServiceLocator()->get('UserService');
    }




} 