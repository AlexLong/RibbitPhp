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
use Zend\Db\Adapter\AdapterInterface;


class UserAggregate extends AbstractDbAggregate {

    protected $tables = array(
        'user'  => 'ribbit_user',
        'profile' => 'ribbit_user_profile'
    );
    protected  $user;
    protected  $profile;

    public function __construct(AdapterInterface $adapter){
           parent::__construct($adapter);
    }
    /**
     * @return mixed
     */
    public function getUser()
    {
        if(!$this->user){
            $this->user = new UserRepository($this->tables['user'],$this->dbAdapter);
        }
        return $this->user;
    }
    /**
     * @return mixed
     */
    public function getProfile()
    {
        if(!$this->profile){
            $this->profile = new UserRepository($this->tables['profile'],$this->dbAdapter);
        }
        return $this->profile;
    }




}