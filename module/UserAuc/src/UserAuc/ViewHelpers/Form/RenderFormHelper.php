<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 6:12 PM
 * 
 */

namespace UserAuc\ViewHelpers\Form;


use Application\Form\FormFactory;
use Application\Form\LoginForm;
use Application\Form\SignForm;
use Zend\Form\View\Helper\AbstractHelper;

class RenderFormHelper extends AbstractHelper {


   protected $underDev = true;

   protected $signForm;

   protected $loginForm;

    public function __invoke($form = null, $name = null)
    {
        if(!$form)
            return $this;

          return  $this->renderForm($form,$name);
    }

    public  function login($underDev = false)
    {

        $form = $this->getLoginForm();
        $form->setUnderDev($underDev);
        return $form;
    }


    public  function sign()
    {
        $form = $this->getSignForm();
        $form->setUnderDev($this->underDev);
        return $form;
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

    /**
     * @param mixed $loginForm
     */
    public function setLoginForm($loginForm)
    {
        $this->loginForm = $loginForm;
    }

    /**
     * @return mixed
     */
    public function getLoginForm()
    {
        return $this->loginForm;
    }




} 