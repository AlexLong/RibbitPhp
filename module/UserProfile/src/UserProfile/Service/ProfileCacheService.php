<?php

namespace UserProfile\Service;


use Application\Service\AbstractCacheService;
use UserProfile\Service\Interfaces\ProfileCacheServiceInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProfileCacheService extends  AbstractCacheService implements  ProfileCacheServiceInterface {

    protected $serviceLocator;

    function setUserProfile($result)
    {
        $key = $this->formatKey($result['username']);
        $this->getCacheService()->setItem($key, $result);
    }
    /**
     * @param string $username
     * @return array
     */
    function getUserProfile($username)
    {
       $key = $this->formatKey($username);
       return $this->getCacheService()->getItem($key);
    }

    /**
     * @param string $username
     * @return boolean
     */
    function removeUserProfile($username)
    {
        $key = $this->formatKey($username);
        return $this->getCacheService()->removeItem($key);
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
       $this->serviceLocator = $serviceLocator;
    }

    public function cacheProfilePic($path){


        //get the last-modified-date of this very file
        $lastModified=filemtime($path);
//get a unique hash of this file (etag)
        $etagFile = md5_file($path);
//get the HTTP_IF_MODIFIED_SINCE header if set
        $ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
//get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
        $etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);

//set last-modified header
        header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
//set etag-header
        header("Etag: $etagFile");
//make sure caching is turned on
        header('Cache-Control: public');
        header('Expires: '. gmdate("D, d M Y H:i:s", time() + 3600 * 24 * 365));

//check if page has changed. If not, send 304 and exit
        $current =  isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;
        if($current){
            if(strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])==$lastModified || $etagHeader == $etagFile){
                header("HTTP/1.1 304 Not Modified");
                exit;
            }
        }

    }

} 