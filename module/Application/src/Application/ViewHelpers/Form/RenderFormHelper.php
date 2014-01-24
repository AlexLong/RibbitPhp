<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 6:12 PM
 * 
 */

namespace Application\ViewHelpers\Form;


use Application\Form\FormFactory;
use Application\Form\LoginForm;
use Application\Form\SignForm;
use Zend\Form\View\Helper\AbstractHelper;

class RenderFormHelper extends AbstractHelper {



   protected $underDev = true;

   protected  $signForm;


    public function __invoke($form = null, $name = null)
    {
        if(!$form)
            return $this;

          return  $this->renderForm($form,$name);
    }



    public  function login($underDev = false)
    {

        $form = new LoginForm($underDev);
        $form->setUnderDev($underDev);
        return $form;
    }


    public  function sign()
    {
        $form = new SignForm();
        $form->setUnderDev($this->underDev);
        return $form;
    }



    public function renderForm($form, $name = null)
    {
        return  FormFactory::CreateForm($form, $name);
    }

    /**
     * @param mixed $signForm
     */
    public function setSignForm($signForm)
    {
        $this->signForm = $signForm;
    }

    /**
     * @return mixed
     */
    public function getSignForm()
    {
        return $this->signForm;
    }



} 