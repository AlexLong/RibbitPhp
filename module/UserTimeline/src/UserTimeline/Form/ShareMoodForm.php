<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 6:16 PM
 * 
 */

namespace UserTimeline\Form;

use Zend\Form\Form;

class ShareMoodForm extends  Form {


    protected $underDev;

    public function __construct($underDev = true, $data = array())
    {
        parent::__construct('ShareMood');

        $this->add(array(
            'name' => 'user_mood',
            'type' => 'Textarea',
            'options' => array(

            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
                'placeholder' => 'Post something'

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
     * @return string
     */
    public function getDefaultMessage()
    {
        return $this->defaultMessage;
    }



    /**
     * @param boolean $underDev
     */
    public function setUnderDev($underDev)
    {
        $this->underDev = $underDev;
    }



} 