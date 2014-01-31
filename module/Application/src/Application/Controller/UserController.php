<?php
/**
 * 
 * User: Windows
 * Date: 1/30/14
 * Time: 12:54 PM
 * 
 */

namespace Application\Controller;





class UserController extends  AbstractBaseController {

    public function chkUnameAction()
    {
        if($this->request->isPost()){
            $data = $this->request->getPost();
            $userFilter = $this->getSignForm()->getInputFilter()->get('username');
            $userFilter->setValue($data['username']);
            if(!$userFilter->isValid()){
                return new \Zend\View\Model\JsonModel($userFilter->getMessages());
            }
            return new \Zend\View\Model\JsonModel(array(1));
        }
        return new \Zend\View\Model\JsonModel(array(-1));
    }
    public function  chkEmailAction()
    {
        if($this->request->isPost()){
            $data = $this->request->getPost();
            $userFilter = $this->getSignForm()->getInputFilter()->get('email');
            $userFilter->setValue($data['email']);
            if(!$userFilter->isValid()){
                return new \Zend\View\Model\JsonModel($userFilter->getMessages());
            }
            return new \Zend\View\Model\JsonModel(array(1));
        }
        return new \Zend\View\Model\JsonModel(array(-1));
    }
    public  function getSignForm()
    {
        return $this->getServiceLocator()->get('SignForm');
    }

} 