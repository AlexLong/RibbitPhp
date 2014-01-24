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
    public $csrf;

    protected $emailValidator;
    protected $usernameValidator;

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

        
         //   var_dump( $this->getEmailValidator());
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                    'name' => 'username',
                    'required' => true,
                    'validators' => array(
                       $this->getUsernameValidator(),
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
                               'pattern' => '/[a-zA-Z0-9_]/',
                                'messages' => array(
                                    \Zend\Validator\Regex::INVALID => 'Please use latin alphanumeric characters  for your username.',
                                     \Zend\Validator\Regex::NOT_MATCH => 'Please use latin alphanumeric characters  for your username.'
                                )
                            )

                        ),
                        array(
                            'name' => 'StringLength',

                            'options' => array(

                                'min' => 2,
                                'max' => 20,
                                'messages' => array(
                                    \Zend\Validator\StringLength::TOO_LONG => 'Your username is too long.',
                                    \Zend\Validator\StringLength::TOO_SHORT => 'Your username must be at least 2 characters.',
                                ),
                            ),

                        ),
                    )
                )
            );


            $inputFilter->add(array(
                    'name' => 'email',
                    'required' => true,
                    'validators' => array(
                    $this->getEmailValidator(),
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

                        ),
                        array(
                            'name' => 'StringLength',

                            'options' => array(

                                'max' => 50,
                                'messages' => array(
                                    \Zend\Validator\StringLength::TOO_LONG => 'Your email is too long.',

                                ),
                            ),

                        ),
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
                        array(
                            'name' => 'StringLength',

                            'options' => array(

                                'min' => 6,
                                'max' => 150,
                                'messages' => array(

                                    \Zend\Validator\StringLength::TOO_LONG => 'Your Password is too long.',
                                    \Zend\Validator\StringLength::TOO_SHORT => 'Password must be at least 6 characters.',
                                ),
                            ),

                        ),
                    ),


                )
            );

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;

    }

    /**
     * @param mixed $usernameValidator
     */
    public function setUsernameValidator($usernameValidator)
    {
        $this->usernameValidator = $usernameValidator;
    }

    /**
     * @return mixed
     */
    public function getUsernameValidator()
    {
        return $this->usernameValidator;
    }

    /**
     * @param mixed $emailValidator
     */
    public function setEmailValidator($emailValidator)
    {
        $this->emailValidator = $emailValidator;
    }

    /**
     * @return mixed
     */
    public function getEmailValidator()
    {
        return $this->emailValidator;
    }





} 