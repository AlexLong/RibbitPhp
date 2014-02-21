<?php
/**
 * 
 * User: Windows
 * Date: 1/10/14
 * Time: 4:19 PM
 * 
 */

namespace UserAuc\Service\Interfaces;

interface AuthenticationServiceInterface {

     function authenticate($postData);

     function logout();

     function is_identified();

     function getUserIdentify();

     function removeUser($userId);
} 