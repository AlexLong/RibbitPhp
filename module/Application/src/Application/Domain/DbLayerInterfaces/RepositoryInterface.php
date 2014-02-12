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
    function findBy(array $where,array $columns,$limit = 1);

    /**
     * @param array $columns
     * @param array $values
     * @param null $where
     * @return mixed
     */
    function addTo(array $values);
    /**
     * Returns entire data in the specified table.
     *
     * @param array $columns
     * @param int $limit
     * @return array
     */
    function  findAll(array $include_columns, $limit = 1);

} 