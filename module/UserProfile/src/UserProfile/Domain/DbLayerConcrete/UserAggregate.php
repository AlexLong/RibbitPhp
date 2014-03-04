<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 12:31 PM
 * 
 */

namespace UserProfile\Domain\DbLayerConcrete;


use Application\Model\DbLayerConcrete\AbstractDbAggregate;
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
     * @return UserRepository
     */
    public function getUser()
    {
        if(!$this->user){
            $this->user = new UserRepository($this->tables['user'],$this->dbAdapter, new User());
        }
        return $this->user;
    }
    /**
     * @return UserProfileRepository
     */
    public function getProfile()
    {
        if(!$this->profile){
            $this->profile = new UserProfileRepository($this->tables['profile'],$this->dbAdapter,new UserProfile());
        }
        return $this->profile;
    }

}