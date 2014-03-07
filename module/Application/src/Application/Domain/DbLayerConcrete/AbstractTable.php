<?php
/**
 *
 * User: Windows
 * Date: 2/6/14
 * Time: 3:01 PM
 *
 */

namespace Application\Domain\DbLayerConcrete;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceLocatorInterface;


abstract class AbstractTable extends TableGateway {


    protected $columns = null;

    protected $entity;
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
    public  function findBy(array $where,array $columns,$limit = 1){
        $result = array();
        $select = $this->getSql()
                ->select()
                ->columns($columns)
                ->where($where)
                ->limit($limit);
        if(is_object($select)){
            if($limit == 1){
                $result = $this->executeSelect($select)->current();

            }else{
                $result = $this->executeSelect($select);
            }

        }
        return $result;
    }
    /**
     * Gets entire data
     *
     * @param array $include_columns
     * @param int $limit
     * @return array
     */

   public function findAll(array $include_columns, $limit = 1){
        $result = array();
        $select = $this->getSql()
                ->select()
                ->columns($include_columns)
                ->limit($limit);
        if(is_object($select)){
            if($limit == 1){
                $result = $this->executeSelect($select)->current();
            }else{
                $result = $this->executeSelect($select);
            }
        }
        return  $result;
    }
    /**
     *  Adds data to the specified table.
     *
     * @param array $values
     *
     * @return mixed
     */
    public function addTo(array $values)
    {
       return $this->execute($this->getSql()->insert()
                ->values($values));
    }


    public function update($set, $where = null){

        if(is_object($set)){
            $set = get_object_vars($set);
        }
        parent::update($set,$where);

    }
    /**
     * @return array|null
     */
    public function getColumns()
    {

        if(!$this->columns){
            $this->columns = array_keys(get_object_vars($this->entity));
        }
        return $this->columns;
    }

} 