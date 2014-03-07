<?php
/**
 * 
 * User: Windows
 * Date: 1/21/14
 * Time: 10:02 PM
 * 
 */

namespace UserAuc\Form\Validator;



use Zend\Validator\AbstractValidator;

abstract class AbstractUserValidator extends  AbstractValidator{

    protected  $userTable;

    public  function __construct(array $options = null)
    {

        parent::__construct($options);
    }

    /**
     * @param mixed $userTable
     */
    public function setUserTable($userTable)
    {

        $this->userTable = $userTable;
    }

    /**
     * @return mixed
     */
    public function getUserTable()
    {
        return $this->userTable;
    }


} 