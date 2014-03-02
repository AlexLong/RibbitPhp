<?php
/**
 * 
 * User: Windows
 * Date: 2/15/14
 * Time: 6:06 PM
 * 
 */

namespace UserProfile\Entity;



use Zend\Stdlib\Hydrator\ArraySerializable;

class UserProfile {

    public $user_id = null;

    public $first_name = null;

    public $last_name = null;

    public $email = null;

    public $profile_picture = null;

    public $profile_url = null;

} 