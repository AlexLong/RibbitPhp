<?php
/**
 * 
 * User: Windows
 * Date: 2/21/14
 * Time: 6:12 PM
 * 
 */

namespace UserProfileEditor\Form;


use Application\Service\UserFolderServiceInterface;
use UserAuc\Service\AuthenticationService;
use UserAuc\Service\Interfaces\AuthenticationServiceInterface;
use UserProfileEditor\Form\Filter\ImageFilter;
use UserProfileEditor\Service\UserDirServiceInterface;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ProfileFormModel implements InputFilterAwareInterface {

    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {

        throw new \Exception("Not used");
    }


    public function getInputFilter()
    {
        if(!$this->inputFilter){
            //   var_dump( $this->getEmailValidator());
            $inputFilter = new InputFilter();


          //  $fileInput->getFilterChain()->attachByName();

            $inputFilter->add(array(
                    'name' => 'first_name',
                    'required' => true,
                    'filters' => array(
                      array(
                          'name' =>'StripTags'
                      )
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'max' => 20,
                                'messages' => array(
                                    \Zend\Validator\StringLength::TOO_LONG => 'Your first name exceeds maximal length.',
                                ),
                            ),

                        ),
                      //  $this->getUsernameValidator(),
                    )
                )
            );
            $inputFilter->add(array(
                    'name' => 'last_name',
                    'required' => true,
                    'filters' => array(
                        array(
                            'name' =>'StripTags'
                        )
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'max' => 20,
                                'messages' => array(
                                    \Zend\Validator\StringLength::TOO_LONG => 'Your last name exceeds maximal length.',
                                ),
                            ),

                        ),
                        //  $this->getUsernameValidator(),
                    )
                )
            );

            $this->inputFilter = $inputFilter;
        }
     //   var_dump($this->inputFilter);
        return $this->inputFilter;
    }


} 