<?php
/**
 * 
 * User: Windows
 * Date: 2/25/14
 * Time: 12:30 PM
 * 
 */

namespace UserProfileEditor\ViewHelper;


use UserAuc\Service\AuthenticationService;
use UserProfile\Domain\Concrete\UserAggregate;
use UserProfile\Service\ProfileCacheService;
use Zend\Form\View\Helper\AbstractHelper;
use Zend\View\Helper\Url;


class UserImgResolver extends  AbstractHelper{


    protected $image_suffix = 'av_';

    protected $authService;

    protected $profileCacheService;

    protected $route = "prof_asset/profile_img";

    protected $user_aggregate;

    public function __invoke(){

        return $this;
    }

    public function has(){

        return $this->getAuthService()->getUserIdentify('user_id');
    }

    public function get($user_id = null){

        if($user_id === null){
            $user_id = $this->getAuthService()->getUserIdentify('id');
            if(!$user_id) return null;
        }

            $res = $this->getUserAggregate()->getProfile()
                ->findBy(array('user_id' => $user_id),array('profile_picture'));

        if(!$res) return null;

        $pic = explode('.',$res['profile_picture']);
        $pic_name = $pic[0];
        $format = $pic[1];
        $url = array(
            'action' => 'profileImg',
            'format' => $format,
            'pic_name' => $pic_name,
            'user_id' => $user_id
        );
       return $url;
    }


    /**
     * @param mixed AuthenticationService
     */
    public function setAuthService($authService)
    {
        $this->authService = $authService;
    }
    /**
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }


    /**
     * @param mixed $user_aggregate
     */
    public function setUserAggregate($user_aggregate)
    {
        $this->user_aggregate = $user_aggregate;
    }

    /**
     * @return UserAggregate
     */
    public function getUserAggregate()
    {
        return $this->user_aggregate;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }




} 