<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:25 PM
 * 
 */



namespace Application\Domain\DbLayerInterfaces;


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
    function  findById($id, array $columns = null);

    /**
     * @param $username
     * @param array $columns
     * @return mixed
     */
    function  findByUsername($username, array $columns = null);
    /**
     * @param $email
     * @param array $columns
     * @return mixed
     */
    function  findByEmail($email, array $columns = null);

    /**
     * @param array $values
     * @return mixed
     */
    function  createUser($values = array());
    /**
     * @param $userId
     * @return mixed
     */
    function dropById($userId);

}