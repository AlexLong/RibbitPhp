<?php
/**
 * 
 * User: Windows
 * Date: 2/21/14
 * Time: 4:58 PM
 * 
 */

namespace UserProfileEditor\Form;


use Zend\Form\Form;



class ProfileForm extends Form {


    protected $underDev = false;


    protected $profileModel;



    public function __construct(){

        parent::__construct('Profile');


        $this->add(array(
            'name' => 'first_name',
            'type' => 'Text',

            'options' => array(
                'label' => 'First Name',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'autocomplete' => 'off',
                'id' => 'first_name'

            ),
        ));
        $this->add(array(
            'name' => 'last_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Last name',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'autocomplete' => 'off',
                'id' => 'last_name'

            ),
        ));


        if(!$this->underDev)
        {
            $token = 'Zend\Form\Element\Csrf';
        }else{
            $token = 'hidden';
        }
        $this->add(array(
                'type' => $token,
                'name' => 'edit_token',
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
                'value' => 'Save',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            ),
        ));

    }

    /**
     * @param mixed $profileModel
     */
    public function setProfileModel($profileModel)
    {
        $this->profileModel = $profileModel;
    }



} 