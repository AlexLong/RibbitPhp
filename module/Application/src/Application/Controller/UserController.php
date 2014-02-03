<?php
/**
 * 
 * User: Windows
 * Date: 1/30/14
 * Time: 12:54 PM
 * 
 */

namespace Application\Controller;





use Application\Model\ChkModel;

class UserController extends  AbstractBaseController {


    protected $chkModel;

    public function chkUserAction()
    {
        if($this->request->isPost()){
           $data = $this->request->getPost();
         return $this->getChkModel()->buildResponse($data);
        }
        return new \Zend\View\Model\JsonModel(array(-1));
    }
    public function getChkModel()
    {
        if(!$this->chkModel){
            $this->setChkModel(new ChkModel());
        }
        return $this->chkModel;
    }

    public function setChkModel(ChkModel $model){
      $model->setLocator($this->getServiceLocator());
       $this->chkModel = $model;
        return $this;
    }


} 