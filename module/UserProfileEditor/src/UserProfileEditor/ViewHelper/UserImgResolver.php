<?php
/**
 * 
 * User: Windows
 * Date: 2/25/14
 * Time: 12:30 PM
 * 
 */

namespace UserProfileEditor\ViewHelper;


use Zend\Form\View\Helper\AbstractHelper;
use Zend\View\Helper\Url;


class UserImgResolver extends AbstractHelper {

   protected  $image_suffix = 'av_';

    public function __invoke(){

        return $this;

    }
    public function get($tmp_file, $user_id){

        if(!$tmp_file) return false;
        $pic = explode('.',preg_filter('/.*[^'.$this->image_suffix.'\w+\.]/','',$tmp_file['tmp_name']));
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





} 