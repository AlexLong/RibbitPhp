<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 6:28 PM
 * 
 */

namespace UserAuc\Model;



use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class LoginModel implements InputFilterAwareInterface {

    public $email;
    public $password;
    public $csrf;

    protected $emailValidator;
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
                  'name' => 'email',
                   'required' => true,
                     'validators' => array(
                      //   $this->getEmailValidator(),
                             array(
                             'name' => 'NotEmpty',
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
                                 'encoding' => 'UTF-8',

                                 'messages' => array(
                                     \Zend\Validator\EmailAddress::INVALID => 'Email has an invalid format.',
                                     \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email has an invalid format.',
                                 ),
                             ),
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
                                        'max' => 60,
                                        'messages' => array(
                                            \Zend\Validator\StringLength::TOO_LONG => 'Your Password is too long.',
                                            \Zend\Validator\StringLength::TOO_SHORT => 'Password must be at least 6 characters.',
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