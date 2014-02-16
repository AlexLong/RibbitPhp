<?php
/**
 * 
 * User: Windows
 * Date: 2/15/14
 * Time: 6:06 PM
 * 
 */

namespace UserProfile\Entity;


class UserProfile {

    public $user_id = null;

    public $username = null;

    public $first_name = null;

    public $last_name = null;

    public $email = null;

    function __construct(array $data)
    {
        $this->exchangeArray($data);
    }
    public function exchangeArray(array $data){
        $user_prop = get_object_vars($this);
        foreach($user_prop as $key => $v){
            $this->{$key} = $data[$key];
        }
    }

} 