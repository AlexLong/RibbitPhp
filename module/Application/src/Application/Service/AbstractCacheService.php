<?php
/**
 * 
 * User: Windows
 * Date: 2/11/14
 * Time: 4:40 PM
 * 
 */

namespace Application\Service;


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

    /**
     * @return null
     */
    public function getCacheService()
    {
        return $this->cacheService;
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