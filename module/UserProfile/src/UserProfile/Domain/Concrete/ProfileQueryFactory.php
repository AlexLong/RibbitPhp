<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 2:41 PM
 * 
 */

namespace UserProfile\Domain\Concrete;


use Application\Domain\DbInterfaces\AggregateDbInterface;
use Zend\Db\Adapter\Adapter;

class ProfileQueryFactory {

    /**
     * @var UserAggregate
     */
    protected $aggregate;

    public function __construct(AggregateDbInterface $aggregate){
        $this->aggregate = $aggregate;
    }

    public function resolveUserProfile($username, $limit = 1){
        $result = null;
        $user_table = $this->aggregate->getTable('user');
        $profile_table = $this->aggregate->getTable('profile');
        $query = "select
                 $user_table.id,
                 $user_table.username,
                 $user_table.email,
                 $profile_table.first_name,
                 $profile_table.last_name,
                 $profile_table.user_id,
                 $profile_table.profile_picture
                 from $user_table
                 join $profile_table on ($user_table.id = $profile_table.user_id )
                 where $user_table.username = '$username'
                 Limit 1";
        $request = $this->aggregate->getDbAdapter()->query($query,Adapter::QUERY_MODE_EXECUTE)->toArray();
        if($limit == 1){
            $result = $request[0];
        }
        return $result;
    }
    public function resolveUserByEmail($email, $limit = 1){
        $result = null;
        $user_table = $this->aggregate->getTable('user');
        $profile_table = $this->aggregate->getTable('profile');
        $query = "select
                $user_table.id,
                $user_table.username,
                $user_table.email,
                $user_table.password,
                 $profile_table.first_name,
                 $profile_table.last_name,
                 $profile_table.user_id,
                 $profile_table.profile_picture
                 from $user_table
                 join $profile_table on ($user_table.id = $profile_table.user_id )
                 where $user_table.email = '$email'
                 Limit 1";
        $request = $this->aggregate->getDbAdapter()->query($query,Adapter::QUERY_MODE_EXECUTE)->toArray();
        if($limit == 1){
            $result = $request[0];
        }
        return $result;
    }

    public function resolveUserById($id){
        $result = null;
        $user_table = $this->aggregate->getTable('user');
        $profile_table = $this->aggregate->getTable('profile');
        $query = "select
                $user_table.id,
                $user_table.username,
                $user_table.email,
                $user_table.password,
                 $profile_table.first_name,
                 $profile_table.last_name,
                 $profile_table.user_id,
                 $profile_table.profile_picture
                 from $user_table
                 join $profile_table on ($user_table.id = $profile_table.user_id )
                 where $user_table.id = '$id'
                 Limit 1";
        $result = $this->aggregate->getDbAdapter()->query($query,Adapter::QUERY_MODE_EXECUTE)->toArray();

        if($result){
            return $result[0];
        }

        return $result;
    }



} 