<?php
/**
 * 
 * User: Windows
 * Date: 1/10/14
 * Time: 4:19 PM
 * 
 */

namespace Application\Service\Interfaces\User;


interface AuthenticationServiceInterface {

     function  authenticate($postData);

     function is_logged();
     

} 