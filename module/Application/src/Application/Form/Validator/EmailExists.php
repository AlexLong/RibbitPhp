<?php
/**
 * 
 * User: Windows
 * Date: 1/14/14
 * Time: 1:09 AM
 * 
 */

namespace Application\Form\Validator;


use Application\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class EmailExists extends  AbstractUserValidator {


    /**
     * Error constants
     */

    const ERROR_EMAIL_FOUND    = 'emailFound';

    protected $messageTemplates = array(
        self::ERROR_EMAIL_FOUND    => "Email address is already in use.",
    );

    public  function __construct(array $options = null)
    {
        parent::__construct($options);
    }

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return bool
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($post_data)
    {
        $valid = true;

        $user = $this->getUserRepository()->findByEmail($post_data,
            array('email'));

        if(($user != null) || (is_array($user) && count($user) > 0) ) {
            $this->error(self::ERROR_EMAIL_FOUND);
            $valid = false;
        }
        return $valid;
    }






} 