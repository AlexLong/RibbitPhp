<?php
/**
 * 
 * User: Windows
 * Date: 2/18/14
 * Time: 9:14 PM
 * 
 */

namespace UserTimeline\Model;


use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ShareMoodModel implements InputFilterAwareInterface {

    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if(!$this->inputFilter){

            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                    'name' => 'user_mood',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'messages' => array(
                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'Please write something.',

                                ),
                            ),
                        ),


                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'max' => 3500,
                                'messages' => array(
                                    \Zend\Validator\StringLength::TOO_LONG => 'The post is too long',

                                ),
                            ),

                        ),

                    )
                )
            );
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }


} 