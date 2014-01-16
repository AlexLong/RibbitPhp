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
use Zend\Validator\Db\AbstractDb;
use Zend\Validator\NotEmpty;

class LoginModel implements InputFilterAwareInterface {

    public $email;
    public $password;
    public $csrf;
    protected $inputFilter;


    public function exchangeArray($data)
    {
        $this->email     = (isset($data['email']))     ? $data['email']     : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->csrf  = (isset($data['csrf']))  ? $data['csrf']  : null;


    }



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
/*
             $inputFilter->add(array(
                     'name' => 'auth_token',
                     'required' => true,
                     'validators' => array(
                         array(
                             'name' => 'Csrf',
                             'options' => array(
                                 'messages' => array(
                                     \Zend\Validator\Csrf::NOT_SAME => 'The security token is missing in your request or invalid. Please try again.'
                                 ),


                             ),

                         ),
                     )
                 )
             );

             */
             $this->inputFilter = $inputFilter;
         }
        return $this->inputFilter;
    }


}