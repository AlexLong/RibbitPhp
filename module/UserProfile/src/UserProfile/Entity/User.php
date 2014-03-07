<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 12:29 PM
 * 
 */

namespace UserProfile\Entity;


class User {

    public $id;

    public $username;

    public $email;

    public $password;
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


} 