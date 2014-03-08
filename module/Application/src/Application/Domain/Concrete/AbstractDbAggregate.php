<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 2:52 PM
 * 
 */

namespace Application\Domain\Concrete;


use Application\Domain\DbInterfaces\AggregateDbInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;

abstract class AbstractDbAggregate  extends  AggregateDbInterface{


    protected $tables = array();

    protected $dbAdapter;

    public function __construct(AdapterInterface $adapter){

        $this->dbAdapter = $adapter;
    }

    /**
     * @return Adapter
     */
    public function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * @param string $name
     * @return string mixed
     */
    public function getTable($name)
    {
        return $this->tables[$name];
    }


} 