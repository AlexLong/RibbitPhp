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
        foreach($values as $key => $v)
        {
            if(!in_array($key,$this->insert_columns))
                unset($values[$key]);
        }
        if(array_key_exists('password',$values)){
            $values['password'] = md5($values['password']);
        }
        $values['registration_date'] = date("Y-m-d H:i:s");

      return  $this->general_repository->AddTo($this->table,$this->insert_columns,
          $values
          );

    }

    
    function dropById($userId)
    {

    $res = $this->findById($userId, array('id'));

    if(!$res){

        return false;
    }
        $statement = $this->general_repository->getSqlManager()->delete($this->table)
            ->where(array('id' => $userId));

        $this->general_repository->execute($statement);

     return true;
    
    }



} 