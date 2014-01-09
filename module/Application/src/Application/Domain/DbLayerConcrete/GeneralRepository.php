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
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GeneralRepository implements  RepositoryInterface, ServiceLocatorAwareInterface {


    protected static $dbAdapter;

    protected $serviceManager;

    protected $entityManager;

    protected  $sqlManager;


    public  function execute($statement)
    {

        $request  = $this->getSqlManager()->getStringForSqlObject($statement);

        return $this->getDbAdapter()->query($request,$this->getDbAdapter()->QUERY_MODE_EXECUTE);

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