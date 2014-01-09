<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:34 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;


use Application\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Zend\Db\Sql\Sql;

class UserRepository extends GeneralRepository implements  UserRepositoryInterface {



    protected  $table = 'ribbit_user';


    public  function __construct()
    {

    }
    function  findById($id)
    {

       $select = $this->getSqlManager()
            ->select()
            ->from($this->table)
            ->columns(array('id'))
            ->where(array('id' => $id))
            ->limit(1);

        $select_string = $this->getSqlManager()->getStringForSqlObject($select);

        $result = $this->dbAdapter->query($select_string,$this->getDbAdapter()->QUERY_MODE_EXECUTE );




        // TODO: Implement findById() method.
    }

    function  findByUsername($username)
    {
        // TODO: Implement findByUsername() method.
    }

    function  findByEmail($email)
    {
        // TODO: Implement findByEmail() method.
    }


} 