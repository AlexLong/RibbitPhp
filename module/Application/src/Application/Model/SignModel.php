<?php
/**
 * 
 * User: Windows
 * Date: 1/22/14
 * Time: 12:27 PM
 * 
 */

namespace Application\Model;


use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class SignModel implements  InputFilterAwareInterface{


    public $username;
    public $email;
    public $password;
    public $password_confirm;
    public $csrf;

    protected $inputFilter;
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

            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                    'name' => 'username',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'messages' => array(
                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'Please enter your username.',

                                ),
                            ),
                        ),
                        array(
                            'name' => 'Regex',
                            'options' => array(
                               'pattern' => '/[^a-zA-Z0-9_]/',
                                'messages' => array(
                                    \Zend\Validator\Regex::INVALID => 'Please use latin alphanumeric characters  for your username.'
                                )
                            )

                        ),
                        array(
                            'name' => 'LessThan',
                            'options' => array(
                               'max' => 255,
                                'messages' => array(
                                    \Zend\Validator\LessThan::NOT_LESS => 'Entered password is too long.'
                                ),
                            )

                        )
                    )
                )
            );


            $inputFilter->add(array(
                    'name' => 'email',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'messages' => array(
                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'Please enter your email.',

                                ),
                            ),
                        ),
                        array(
                            'name' => 'EmailAddress',
                            'options' => array(
                                'messages' => array(
                                    \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Please enter a valid email',
                                    \Zend\Validator\EmailAddress::INVALID => 'Please enter a valid email'

                                )
                            )

                        )
                    )
                )
            );
            $inputFilter->add(array(
                    'name' => 'password',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'messages' => array(
                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'Please enter your password.',
                                ),
                            ),

                        ),
                    )
                )
            );
            $inputFilter->add(array(
                    'name' => 'password_confirm',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'messages' => array(
                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'Please re-enter your password.',
                                ),
                            ),

                        ),
                    )
                )
            );

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
        // TODO: Implement getInputFilter() method.
    }


} 