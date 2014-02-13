<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:25 PM
 * 
 */



namespace  UserProfile\Domain\DbLayerInterfaces;

use Application\Domain\DbLayerInterfaces\RepositoryInterface;

/**
 * Interface UserRepositoryInterface
 * @package Application\Domain\DbLayerInterfaces
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    function  findById($id, array $columns);

    /**
     * @param $username
     * @param array $columns
     * @return mixed
     */
    function  findByUsername($username, array $columns);
    /**
     * @param $email
     * @param array $columns
     * @return mixed
     */
    function  findByEmail($email, array $columns);

    /**
     * @param array $values
     * @return mixed
     */
    function  createUser(array $values);
    /**
     * @param $userId
     * @return mixed
     */
    function dropById($userId);

}