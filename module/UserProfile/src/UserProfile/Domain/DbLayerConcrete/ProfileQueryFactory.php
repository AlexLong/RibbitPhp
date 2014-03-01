<?php
/**
 * 
 * User: Windows
 * Date: 3/1/14
 * Time: 2:41 PM
 * 
 */

namespace UserProfile\Domain\DbLayerConcrete;


use Application\Model\DbLayerInterfaces\AggregateDbInterface;

class ProfileQueryFactory {


    /**
     * @var UserAggregate
     */
    protected $aggregate;


    public function __construct(AggregateDbInterface $aggregate){
        $this->aggregate = $aggregate;
    }

    public function resolveUserProfile($username){
        $user_table = $this->aggregate->getUser()->getTable();
        $profile_table = $this->aggregate->getProfile()->getTable();
        $query = "select
                 $user_table.id,
                 $user_table.username,
                 $user_table.email,
                 $profile_table.first_name,
                 $profile_table.last_name,
                 $profile_table.user_id
                 from $user_table
                 join $profile_table on ($user_table.id = $profile_table.user_id )
                 where $user_table.username = '$username'
                 Limit 1";

        return $this->aggregate->getDbAdapter()->execute($query)->toArray();
    }

} 