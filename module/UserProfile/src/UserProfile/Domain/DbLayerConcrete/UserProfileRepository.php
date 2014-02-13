<?php
/**
 * 
 * User: Windows
 * Date: 2/9/14
 * Time: 1:48 PM
 * 
 */

namespace UserProfile\Domain\DbLayerConcrete;

use Application\Domain\DbLayerConcrete\AbstractRepository;
use UserProfile\Domain\DbLayerInterfaces\UserProfileRepositoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserProfileRepository extends  AbstractRepository implements UserProfileRepositoryInterface{

    function createProfile(array $userData )
    {
        return $this->addTo($userData);
    }
    /**
     * Finds a user profile based on id
     *
     * @param int $user_id
     * @param array $columns
     * @return mixed
     */
    function findByUserId($user_id,array $columns = null)
    {
        return $this->findBy(array('user_id' => $user_id),$columns);
    }
    /**
     * Ads/Changes data in user profile.
     *
     * @param array $dataToChange
     * @param array $where
     * @return mixed
     */

    function updateProfile($dataToChange = array(), $where = array())
    {
        return $this->addTo($dataToChange, $where);
    }
    /**
     * Removes a User profile based on passed id.
     *
     * @param int $user_id
     * @return \Zend\Db\Sql\Delete
     */
    function deleteUserProfile($user_id)
    {
        return $this->getSql()->delete()->where(array('user_id' => $user_id) );
    }


}


