<?php

namespace Application\Domain\Entity;
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer") @GeneratedValue
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string",length=32)
     */
    private $password;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $role;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }
}