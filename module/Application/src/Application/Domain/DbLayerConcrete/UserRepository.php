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
use Zend\Db\Sql\Sql;

class UserRepository implements  UserRepositoryInterface {


    protected static $table = 'ribbit_user';

    protected $general_repository;

    public  function __construct(RepositoryInterface $repository)
    {
        $this->general_repository = $repository;
    }

    function  findById($id)
    {
          $select = $this->general_repository->getSqlManager()
            ->select()
            ->from(self::$table)
            ->where(array('id' => $id))
            ->limit(1);
     return  $this->general_repository->execute($select);

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