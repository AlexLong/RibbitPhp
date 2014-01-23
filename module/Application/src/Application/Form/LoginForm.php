<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 6:16 PM
 * 
 */

namespace Application\Form;

use Zend\Form\Form;

class LoginForm extends  Form {


    protected $underDev;

    public function __construct($underDev = true, $data = array())
    {
        parent::__construct('login');

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',

            'options' => array(
                'label' => 'Email Address',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,

            ),
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true

            ),
        ));

        $this->add(array(
            'name' => 'remember_me',
            'type' => 'Checkbox',

            'options' => array(
                'label' => 'Remember me on this computer?',
            ),
            'attributes' => array(
                'checked' => 'checked'
            )
        ));

        if(!$underDev)
        {
            $token = 'Zend\Form\Element\Csrf';
        }else{
            $token = 'hidden';
        }


            $this->add(array(

                    'type' => $token,
                    'name' => 'auth_token',
                    'options' => array(
                        'csrf_options' => array(
                            'timeout' => 600
                        )
                    ),
                    'attributes' => array(
                        'id' => 'auth_token'
                    ),
                )
            );

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            ),

        ));

    }



    /**
     * @param boolean $underDev
     */
    public function setUnderDev($underDev)
    {
        $this->underDev = $underDev;
    }



} 