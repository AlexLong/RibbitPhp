<?php
/**
 * 
 * User: Windows
 * Date: 2/11/14
 * Time: 4:08 PM
 * 
 */

namespace UserProfile\Service\Interfaces;


interface UserProfileCacheServiceInterface {

    /**
     * @param string $username
     * @param mixed $value
     * @return mixed
     */

    function setUserProfile($username, $value);
    /**
     * @param string $username
     * @return array
     */
    function getUserProfile($username);

    /**
     * @param string $username
     * @return boolean
     */
    function removeUserProfile($username);

} 