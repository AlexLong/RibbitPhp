<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 9:31 AM
 * 
 */
/**
 * Class User
 * @package Application\Entity
 */
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\RibbitUser
 *
 * @ORM\Table(name="ribbit_user", indexes={@ORM\index(name="search_idx", columns={"username", "email"})}))
 * @Orm\Entity
 */

class RibbitUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected  $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     **/
    protected  $username;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * */
    protected  $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime")
     **/
    protected $registration_date;

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

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $registration_date
     */
    public function setRegistrationDate($registration_date)
    {
        $this->registration_date = $registration_date;
    }

    /**
     * @return mixed
     */
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }






} 