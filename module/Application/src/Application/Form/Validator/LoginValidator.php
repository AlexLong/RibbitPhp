<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 1:09 AM
 * 
 */

namespace Application\Form\Validator;


use Zend\Validator\Db\NoRecordExists;

class LoginValidator extends  NoRecordExists {




    public  function __construct(array $options)
    {
        parent::__construct($options);

    }





} 