<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 2:52 PM
 * 
 */

namespace Application\Model\DbLayerConcrete;


use Application\Model\DbLayerInterfaces\AggregateDbInterface;

use Zend\Db\Adapter\AdapterInterface;

abstract class AbstractDbAggregate  extends  AggregateDbInterface{


    protected $tables = array();

    protected $dbAdapter;

    public function __construct(AdapterInterface $adapter){
        $this->dbAdapter = $adapter;
    }

    /**
     * @return mixed
     */
    public function getDbAdapter()
    {
        return $this->dbAdapter;
    }



} 