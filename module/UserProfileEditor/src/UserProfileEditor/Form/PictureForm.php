<?php
/**
 * 
 * User: Windows
 * Date: 3/3/14
 * Time: 7:37 PM
 * 
 */

namespace UserProfileEditor\Form;






use Zend\Form\Form;

class PictureForm extends Form {


    protected $underDev = false;


    protected $pictureModel;

    public function __construct(){
        parent::__construct('Picture');

        $this->add(array(
            'name' => 'profile_picture',
            'type' => 'File',

            'options' => array(
                'label' => 'Your Picture',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'autocomplete' => 'off',
                'id' => 'profile_picture'
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
        )
       );

    }









} 