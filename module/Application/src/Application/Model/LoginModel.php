<?php
/**
 * 
 * User: Windows
 * Date: 1/11/14
 * Time: 6:28 PM
 * 
 */

namespace Application\Model;



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
                         $this->getEmailValidator(),
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