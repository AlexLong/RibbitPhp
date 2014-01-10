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


    protected $dbAdapter;

    protected $serviceManager;

    protected $entityManager;

    protected $sqlManager;


    public  function execute($statement)
    {

        $request = $this->getSqlManager()->getSqlStringForSqlObject($statement);
        return $this->getDbAdapter()->query($request,Adapter::QUERY_MODE_EXECUTE);
    }

    public  function findBy($where = array(),$table,$columns = null,$limit = 1){

        if($columns == null)
        {
            $select = $this->getSqlManager()
                ->select()
                ->from($table)
                ->where($where)
                ->limit($limit);
        }elseif($columns)
        {
               $select = $this->getSqlManager()
                ->select()
                ->from($table)
                ->columns($columns)
                ->where($where)
                ->limit($limit);
        }

        $result = $this->execute($select);
        return $result->toArray();

    }


    public  function setSqlManager(Sql $sql)
    {
        $this->sqlManager = $sql;
    }

    public function getSqlManager()
    {
        return $this->sqlManager;
    }

    public function setDbAdapter( AdapterInterface $dbAdapter )
    {
        $this->dbAdapter = $dbAdapter;
    }

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

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public  function  getEntityManager()
    {
        return $this->entityManager;
    }





} 