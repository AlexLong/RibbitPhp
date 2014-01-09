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

class UserRepository extends GeneralRepository implements  UserRepositoryInterface {

    protected $dbAccessor;
    public  function __construct()
    {

    }
    function  findById($id)
    {


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