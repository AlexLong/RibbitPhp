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
     * @param null $columns
     * @param int $limit
     * @return array
     */
    function findBy($where = array(),array $columns = null,$limit = 1);

    /**
     * @param array $columns
     * @param array $values
     * @param null $where
     * @return mixed
     */
    function addTo($values = array(),array $where = null);
    /**
     * Returns entire data in the specified table.
     *
     * @param array $columns
     * @param int $limit
     * @return array
     */
    function  findAll($columns = array(),$limit = 1);

} 