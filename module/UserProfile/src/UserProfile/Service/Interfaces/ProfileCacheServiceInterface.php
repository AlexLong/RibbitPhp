<?php
/**
 * 
 * User: Windows
 * Date: 2/11/14
 * Time: 4:08 PM
 * 
 */

namespace UserProfile\Service\Interfaces;


interface ProfileCacheServiceInterface {


    /**
     * @param array $result
     * @return void
     */
    function setUserProfile($result);
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