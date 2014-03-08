<?php

namespace UserProfile\Domain\Concrete;

use Application\Domain\Concrete\AbstractTable;
use UserProfile\Entity\User;
use Zend\Db\Adapter\AdapterInterface;

class UserTable extends AbstractTable {

   protected $insert_columns = array('email', 'username', 'password',
        'registration_date');



    public function __construct($table,AdapterInterface $adapter,User $user){
        parent::__construct($table,$adapter);
        $this->entity = $user;
    }

    function  findById($id, array $columns = null)
    {
        if($columns == null){
            $columns = $this->getColumns();
        }
         return $this->findBy(array('id' => $id),$columns);
    }
    function  findByUsername($username, array $columns = null)
    {
        if($columns == null){
            $columns = $this->getColumns();
        }
        return $this->findBy(array('username' => $username),$columns);
    }
    function  findByEmail($email, array $columns = null)
    {
        if($columns == null){
            $columns = $this->getColumns();
        }
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