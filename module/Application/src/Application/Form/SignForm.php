<?php
/**
 * 
 * User: Windows
 * Date: 1/22/14
 * Time: 11:30 AM
 * 
 */

namespace Application\Form;



use Zend\Form\Form;

class SignForm extends Form{

    protected $underDev;

    public function __construct($underDev = true)
    {
        parent::__construct('sign');

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
            'name' => 'username',
            'type' => 'Text',

            'options' => array(
                'label' => 'Username',
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
            'name' => 'password_confirmation',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true

            ),
        ));



        if(!$underDev)
        {
            $token = 'Zend\Form\Element\Csrf';
        }else{
            $token = 'hidden';
        }


        $this->add(array(
                'type' => $token,
                'name' => 'sign_token',
                'options' => array(
                    'csrf_options' => array(
                        'timeout' => 600
                    )
                ),
                'attributes' => array(
                    'id' => 'sign_token'
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