<?php
/**
 * 
 * User: Windows
 * Date: 2/24/14
 * Time: 11:21 PM
 * 
 */

namespace UserProfileEditor\Service;


interface UserDirServiceInterface {
    function createProfileImageDir($user_id);
    function profileDirPath($user_id);
    function profilePicPath($user_id);

} 