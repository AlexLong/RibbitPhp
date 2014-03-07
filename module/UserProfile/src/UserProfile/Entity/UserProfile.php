<?php
/**
 * 
 * User: Windows
 * Date: 2/15/14
 * Time: 6:06 PM
 * 
 */

namespace UserProfile\Entity;



use Application\Entity\AbstractEntity;

class UserProfile extends AbstractEntity {

    public $user_id = null;

    public $first_name = null;

    public $last_name = null;

    public $profile_picture = null;

    public $profile_url = null;

    public function __construct(array $newData = null){
        if($newData){
            $this->ExchangeArray($newData);
        }
    }


} 