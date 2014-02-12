<?php
/**
 *
 * User: Windows
 * Date: 2/6/14
 * Time: 3:01 PM
 *
 */

namespace Application\Domain\DbLayerConcrete;
use Application\Domain\DbLayerInterfaces\RepositoryInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceLocatorInterface;


abstract class AbstractRepository extends TableGateway implements RepositoryInterface {


    /**
     * Executes statement and returns a result of a request.
     *
     * @param $statement
     * @return mixed
     */
    public function execute($statement)
    {
        $result = null;

        if(is_object($statement)){
            $request = $this->getSql()->getSqlStringForSqlObject($statement);
            $result = $this->getAdapter()->query($request,Adapter::QUERY_MODE_EXECUTE);
        }elseif(is_array($statement)){
            $result = array();
            foreach($statement as $st){
                if(is_object($st)){
                    $request = $this->getSql()->getSqlStringForSqlObject($st);
                    $result[] = $this->getAdapter()->query($request,Adapter::QUERY_MODE_EXECUTE);
                }else{
                    // Is a pain statement.
                    $result[] = $this->getAdapter()->query($st,Adapter::QUERY_MODE_EXECUTE);
                }
            }
        }else{
            // Is a pain statement.
            $result = $this->getAdapter()->query($statement,Adapter::QUERY_MODE_EXECUTE);
        }
        return $result;
    }


    /**
     * Find data by specified element.
     *
     * @param array $where
     * @param array $columns
     * @param int $limit
     * @return array
     */
    public  function findBy($where = array(),array $columns = null,$limit = 1){
        $select = null;
        $result = array();

        if($columns == null)
        {
            $select = $this->getSql()
                ->select()
                ->where($where)
                ->limit($limit);

        }elseif(is_array($columns))
        {

            $select = $this->getSql()
                ->select()
                ->columns($columns)
                ->where($where)
                ->limit($limit);
        }
        if($select){
            $result = $this->executeSelect($select)->toArray();
        }
        return  (count($result) == 1 ) ? $result[0] : $result;
    }
    /**
     * Gets entire data
     *
     * @param array $columns
     * @param int $limit
     * @return array
     */
    public function  findAll($columns = array(), $limit = 1){


        $select = null;
        $result = array();
        if($columns == null)
        {
            $select = $this->getSql()
                ->select()
                ->limit($limit);
        }elseif(is_array($columns)){
            $select = $this->getSql()
                ->select()
                ->columns($columns)
                ->limit($limit);
        }

        if($select){
            $result = $this->executeSelect($select)->toArray();
        }

        return  (count($result) == 1 ) ? $result[0] : $result;
    }


    /**
     *  Adds data to the specified table.
     *
     * @param array $values
     * @param array $where
     * @return mixed|\Zend\Db\Sql\Select
     */
    public function addTo($values = array(), array $where = null)
    {

        if($where == null){
            return $this->execute($this->getSql()->insert()
                ->values($values));
        }
        return $this->getSql()->update()->set($values)->where($where);
    }


} 