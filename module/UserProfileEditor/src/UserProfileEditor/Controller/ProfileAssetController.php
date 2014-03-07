<?php
/**
 * 
 * User: Windows
 * Date: 2/25/14
 * Time: 7:43 PM
 * 
 */

namespace UserProfileEditor\Controller;


use Application\Strategy\StrategyModel\ImageModel;
use UserProfile\Service\ProfileCacheService;
use Zend\Http\Client;
use Zend\Http\Headers;
use Zend\Http\Response;
use Zend\Mime\Mime;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Uri\File;
use Zend\Validator\File\MimeType;

class ProfileAssetController extends AbstractActionController {

    protected $dirService;

    protected $cacheService;

    public function profileImgAction(){

       $route = $this->getEvent()->getRouteMatch()->getParams();

        $path = join(DIRECTORY_SEPARATOR,array(
                $this->getDirService()->profilePicPath($route['user_id'] ),
                $route['pic_name'].".".$route['format'] )
        );

        if(!is_file($path)){
            return $this->notFoundAction();
        }
        $this->getCacheService()->cacheProfilePic($path);
        return new ImageModel(array('image' => $path));

    }
    public function getDirService(){

        if(!$this->dirService){
            $this->dirService = $this->getServiceLocator()->get('userDirManager');
        }
    return $this->dirService;
    }

    /**
     * @return ProfileCacheService
     */
    public function getCacheService(){

        if(!$this->cacheService){
            $this->cacheService = $this->getServiceLocator()->get('profileCacheService');
        }
      return $this->cacheService;
    }

} 