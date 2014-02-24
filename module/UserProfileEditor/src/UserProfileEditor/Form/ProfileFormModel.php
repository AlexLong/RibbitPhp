<?php
/**
 * 
 * User: Windows
 * Date: 2/21/14
 * Time: 6:12 PM
 * 
 */

namespace UserProfileEditor\Form;


use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ProfileFormModel implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $fileInputFilter;

    protected $changeEmailValidator;
    protected $changeUsernameValidator;
    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
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


            //   var_dump( $this->getEmailValidator());
            $inputFilter = new InputFilter();

            $fileInput = new FileInput();
            $fileInput->getValidatorChain()
                       ->attachByName("filesize",array('max' => '5MB' ))
                       ->attachByName('filemimetype',  array('mimeType' =>
                                    'image/png,image/x-png,image/gif,
                                    image/jpeg,image/bmp'))
                ->attachByName('fileimagesize', array('maxWidth' => 5000, 'maxHeight' => 5000));
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


            $inputFilter->add(array(
                    'name' => 'profile_picture',

                    /*
                    'validators' => array(
                        array(
                            'name' =>'IsImage',
                            'options' => array(
                                'mimeType' => array(
                                    'image/gif',
                                    'image/jpeg',
                                    'image/bmp',
                                    'image/png',
                                    'image/x-png',
                                )
                            )

                        ),
                        array(
                            'name' =>'Upload',

                        ),
                        array(
                           'name' => 'Size',
                            'options' => array(
                               'max' => '5MB'
                            )
                        )


                        //  $this->getUsernameValidator(),
                    )
                    */
                )
            );


            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }



} 