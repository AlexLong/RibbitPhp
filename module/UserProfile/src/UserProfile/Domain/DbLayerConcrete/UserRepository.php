<?php

namespace UserProfile\Domain\DbLayerConcrete;

use Application\Domain\DbLayerConcrete\AbstractRepository;
use UserProfile\Domain\DbLayerInterfaces\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {


    protected $insert_columns = array('email', 'username', 'password',
        'registration_date');

    function  findById($id, array $columns)
    {
         return $this->findBy(array('id' => $id),$columns);
    }
    function  findByUsername($username, array $columns)
    {
        return $this->findBy(array('username' => $username),$columns);
    }
    function  findByEmail($email, array $columns)
    {
        return $this->findBy(array('email' => $email),$columns);
    }

    function createUser(array $values )
    {
        $result = null;
        foreach($values as $key => $v)
        {
            if(!in_array($key,$this->insert_columns))
                unset($values[$key]);
        }
        if(isset($values['password'])){
            $values['password'] = md5($values['password']);
        }
        $values['registration_date'] = date("Y-m-d H:i:s");

        if($this->addTo($values)){
            $result = $this->findByUsername(
                $values['username'], array('id'));
        }
      return $result;
    }
    function dropById($userId)
    {
     $statement = $this->getSql()->delete()->where(array('id' => $userId));
     return   $this->executeDelete($statement);
    }





} 