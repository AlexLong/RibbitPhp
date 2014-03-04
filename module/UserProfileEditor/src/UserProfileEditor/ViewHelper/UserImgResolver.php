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
use Zend\Form\View\Helper\AbstractHelper;
use Zend\View\Helper\Url;


class UserImgResolver extends  AbstractHelper{


    protected  $image_suffix = 'av_';

    protected  $authService;

    protected $route = "prof_asset/profile_img";

    public function __invoke(){
        return $this;
    }

    public function has(){
        $user_picture = $this->getAuthService()->getUserIdentify('profile_picture');
        return $user_picture ?: false;
    }

    public function get(){

        $user_id = $this->getAuthService()->getUserIdentify('user_id');
        $user_picture = $this->getAuthService()->getUserIdentify('profile_picture');
        if(!$user_picture) return null;
        $pic = explode('.',$user_picture);
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
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }




} 