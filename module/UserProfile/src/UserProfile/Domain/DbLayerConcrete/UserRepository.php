<?php

namespace UserProfile\Domain\DbLayerConcrete;

use Application\Domain\DbLayerConcrete\AbstractRepository;
use UserProfile\Domain\DbLayerInterfaces\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

    protected $insert_columns = array('email', 'username', 'password',
        'registration_date');

    function  findById($id, array $columns = null)
    {
         return $this->findBy(array('id' => $id),$columns);
    }
    function  findByUsername($username, array $columns = null)
    {
        return $this->findBy(array('username' => $username),$columns);
    }
    function  findByEmail($email, array $columns = null)
    {
        return $this->findBy(array('email' => $email),$columns);
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

      return $this->addTo($values);
    }

    function dropById($userId)
    {
     $statement = $this->getSql()->delete()->where(array('id' => $userId));
     return   $this->execute($statement);
    }



} 