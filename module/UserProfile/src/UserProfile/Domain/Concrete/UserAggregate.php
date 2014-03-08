<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 12:31 PM
 * 
 */

namespace UserProfile\Domain\Concrete;


use Application\Domain\Concrete\AbstractDbAggregate;
use UserProfile\Entity\User;
use UserProfile\Entity\UserProfile;


class UserAggregate extends AbstractDbAggregate {

    protected $tables = array(
        'user'  => 'ribbit_user',
        'profile' => 'ribbit_user_profile'
    );

    protected  $user;
    protected  $profile;
    /**
     * @return UserTable
     */
    public function getUser()
    {
        if(!$this->user){
            $this->user = new UserTable($this->tables['user'],$this->dbAdapter, new User());
        }
        return $this->user;
    }
    /**
     * @return UserProfileTable
     */
    public function getProfile()
    {
        if(!$this->profile){
            $this->profile = new UserProfileTable($this->tables['profile'],$this->dbAdapter,new UserProfile());
        }
        return $this->profile;
    }

}