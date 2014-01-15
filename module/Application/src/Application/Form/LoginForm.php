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


    public function __construct($name = null)
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
                'required' => true

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
                'label' => 'Remember Me?',
            ),
            'attributes' => array(
                'checked' => 'checked'
            )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Csrf',
                'name' => 'csrf',
                'options' => array(
                    'csrf_options' => array(
                      //  'timeout' => 600
                    )
                )
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

} 