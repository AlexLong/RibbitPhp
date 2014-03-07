<?php
/**
 * 
 * User: Windows
 * Date: 2/11/14
 * Time: 4:40 PM
 * 
 */

namespace Application\Service;


use Zend\Cache\Storage\Adapter\AbstractAdapter;

abstract class AbstractCacheService {


    protected $namespace = null;

    protected $cacheService = null;

    /**
     * @param null $cacheService
     */
    public function setCacheService($cacheService)
    {
        $this->cacheService = $cacheService;
    }


    public function getCacheService()
    {
        return $this->cacheService;
    }
    public function formatKey($key)
    {
        $escaped_key = strtolower(preg_replace('/[^a-z0-9_\+\-]+/',"",$key));
        return $this->getNamespace().$escaped_key;
    }
    /**
     * @param null $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }
    /**
     * @return null
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

} 