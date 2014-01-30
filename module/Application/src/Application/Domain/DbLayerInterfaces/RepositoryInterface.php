<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:31 PM
 * 
 */

namespace Application\Domain\DbLayerInterfaces;


/**
 * Interface RepositoryInterface
 * @package Application\Domain\DbLayerInterfaces
 */
interface RepositoryInterface {

    /**
     * @param $statement
     * @return mixed
     */
    public function execute($statement);

    /**
     * @param array $where
     * @param $table
     * @param null $columns
     * @param int $limit
     * @return mixed
     */
    public  function findBy($where = array(),$table,$columns = null,$limit = 1);

    /**
     * @param $table
     * @param array $columns
     * @param array $values
     * @param null $where
     * @return mixed
     */
    function AddTo($table, $columns = array(), $values = array(),  $where = null);

    /**
     * @return mixed
     */
    public function getSqlManager();

    /**
     * @return mixed
     */
    public function getDbAdapter();

    /**
     * @return mixed
     */
    public  function getServiceLocator();

} 