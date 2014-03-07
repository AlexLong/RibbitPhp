<?php
/**
 * 
 * User: Windows
 * Date: 2/2/14
 * Time: 5:08 PM
 * 
 */

namespace UserAuc\Model;

class ChkModel {
    protected $signForm;
    public function  buildResponse($data){
        $type = $data['type'];
        try{
            $userFilter = $this->getSignForm()->getInputFilter()->get($type);
        }catch (\Exception $e){
            return new \Zend\View\Model\JsonModel(array(-1));
        }
        $userFilter->setValue($data[$type]);
        if(!$userFilter->isValid()){
            $response = array_merge($userFilter->getMessages(), array('valid' => -1));
            return new \Zend\View\Model\JsonModel($response);
        }
        return new \Zend\View\Model\JsonModel(array(1));
    }

    protected  function getSignForm()
    {

        return $this->signForm;
    }

    public function setSignForm($signForm)
    {
        $this->signForm = $signForm;
    }



} 