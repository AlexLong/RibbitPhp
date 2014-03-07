<?php
/**
 * 
 * User: Windows
 * Date: 2/7/14
 * Time: 8:19 PM
 * 
 */

namespace UserProfile\Service\Interfaces;


interface UserProfileServiceInterface {

    function getUserProfile($username, $fromCache = true);

    function isProfileOwner($user_id);


}