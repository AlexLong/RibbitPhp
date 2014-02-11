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
use Zend\ServiceManager\ServiceLocatorInterface;


abstract class AbstractRepository implements RepositoryInterface {


    protected $table = null;
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

    public function __construct(ServiceLocatorInterface $sm){

        $this->setServiceLocator($sm);
        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        $sql = new Sql($dbAdapter);
        $this->setSqlManager($sql);
        $this->setDbAdapter($dbAdapter);
        $this->setServiceLocator($sm);
    }

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
            $request = $this->getSqlManager()->getSqlStringForSqlObject($statement);
            $result = $this->getDbAdapter()->query($request,Adapter::QUERY_MODE_EXECUTE);
        }elseif(is_array($statement)){
            $result = array();
            foreach($statement as $st){
                if(is_object($st)){
                    $request = $this->getSqlManager()->getSqlStringForSqlObject($st);
                    $result[] = $this->getDbAdapter()->query($request,Adapter::QUERY_MODE_EXECUTE);
                }else{
                    // Is a pain statement.
                    $result[] = $this->getDbAdapter()->query($st,Adapter::QUERY_MODE_EXECUTE);
                }
            }
        }else{
            // Is a pain statement.
            $result = $this->getDbAdapter()->query($statement,Adapter::QUERY_MODE_EXECUTE);
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
        if($columns == null)
        {
            $select = $this->getSqlManager()
                ->select()
                ->from($this->getTable())
                ->where($where)
                ->limit($limit);
        }elseif(is_array($columns))
        {
            $select = $this->getSqlManager()
                ->select()
                ->from($this->table)
                ->columns($columns)
                ->where($where)
                ->limit($limit);
        }
        $result = $this->execute($select)->toArray();
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
        if($columns == null)
        {
            $select = $this->getSqlManager()
                ->select()
                ->from($this->getTable())
                ->limit($limit);
        }elseif(is_array($columns)){
            $select = $this->getSqlManager()
                ->select()
                ->from($this->getTable())
                ->columns($columns)
                ->limit($limit);
        }
        $result = $this->execute($select)->toArray();
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
            return $this->execute($this->sqlManager->insert($this->table)
                ->values($values));
        }
        return $this->sqlManager->update($this->getTable())->set($values)->where($where);
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
    /**
     * @return null
     */
    public function getTable()
    {
        return $this->table;
    }

} 