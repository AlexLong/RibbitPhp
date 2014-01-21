<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:34 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;


use Application\Domain\DbLayerInterfaces\RepositoryInterface;
use Application\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class UserRepository implements  UserRepositoryInterface {


    protected $table = 'ribbit_user';

    protected $general_repository;

    protected $insert_columns = array('email', 'username', 'password',
        'registration_date', 'role');

    public  function __construct(RepositoryInterface $repository)
    {
        $this->general_repository = $repository;
    }
    function  findById($id, array $columns = null)
    {
         return $this->general_repository->findBy(array('id' => $id),$this->table,$columns);
    }
    function  findByUsername($username, array $columns = null)
    {
        return $this->general_repository->findBy(array('username' => $username),$this->table,$columns);
    }
    function  findByEmail($email, array $columns = null)
    {
        return $this->general_repository->findBy(array('email' => $email),$this->table,$columns);
    }

    function createUser($values = array())
    {
      return  $this->general_repository->AddTo($this->table,$this->insert_columns,$values);
    }




} 