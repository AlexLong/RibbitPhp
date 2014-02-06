<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:33 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;


use Application\Domain\DbLayerInterfaces\RepositoryInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GeneralRepository implements  RepositoryInterface, ServiceLocatorAwareInterface {


    /**
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $dbAdapter;

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * @var
     */
    protected $entityManager;

    /**
     * @var \Zend\Db\Sql\Sql
     */
    protected $sqlManager;

    /**
     * Executes the formed SQL statement.
     *
     * @param $statement
     * @return mixed
     */
    public  function execute($statement)
    {
        if(is_object($statement)){
            
            $request = $this->getSqlManager()->getSqlStringForSqlObject($statement);
        }  else {
            $request= $statement;
        }
        
        return $this->getDbAdapter()->query($request,Adapter::QUERY_MODE_EXECUTE);
    }

    /**
     * Find data by specified element.
     *
     * @param array
     * @param $table
     * @param null $columns
     * @param int $limit
     * @return mixed
     */
    public  function findBy($where = array(),$table,$columns = array(),$limit = 1){
        if($columns == null)
        {
            $select = $this->getSqlManager()
                ->select()
                ->from($table)
                ->where($where)
                ->limit($limit);
        }elseif(is_array($columns))
        {
               $select = $this->getSqlManager()
                ->select()
                ->from($table)
                ->columns($columns)
                ->where($where)
                ->limit($limit);
        }
        $result = $this->execute($select)->toArray();
        return  (count($result) == 1 ) ? $result[0] : $result;
    }

    public function  findAll($table, $columns = array(), $limit = 1){

        if($columns == null)
        {
            $select = $this->getSqlManager()
                    ->select()
                    ->from($table)
                    ->limit($limit);
        }elseif(is_array($columns)){
            $select = $this->getSqlManager()
                ->select()
                ->from($table)
                ->columns($columns)
                ->limit($limit);
        }

        $result = $this->execute($select)->toArray();
        return  (count($result) == 1 ) ? $result[0] : $result;
    }

    /**
     * Add data to the specified table.
     * @param $table
     * @param array $columns
     * @param array $values
     * @param null $where
     * @return mixed
     */
    public function AddTo($table, $columns = array(), $values = array(),  $where = null)
    {

        if($where == null){
           return $this->execute($this->sqlManager->insert($table)
                ->columns($columns)
                ->values($values));
        }

       return $this->sqlManager->update($table)->set($values)->where($where);
    }




    /**
     * @param Sql $sql
     */
    public  function setSqlManager(Sql $sql)
    {
        $this->sqlManager = $sql;
    }

    /**
     * @return mixed
     */
    public function getSqlManager()
    {
        return $this->sqlManager;
    }

    /**
     * @param AdapterInterface $dbAdapter
     */
    public function setDbAdapter( AdapterInterface $dbAdapter )
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @return mixed
     */
    public  function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceManger)
    {
        $this->serviceManager = $serviceManger;
    }
    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
       return $this->serviceManager;
    }

    /**
     * @param $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return mixed
     */
    public  function  getEntityManager()
    {
        return $this->entityManager;
    }





} 