<?php
/**
 * 
 * User: Windows
 * Date: 2/7/14
 * Time: 8:16 PM
 * 
 */

namespace UserProfile\Service\User;


use UserProfile\Service\Interfaces\UserServiceInterface;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserService implements ServiceLocatorAwareInterface, UserServiceInterface{


    protected $serviceLocator;

    protected $userProfile;

    protected $userTable;

    function getUserProfileByUsername($username)
    {
        $id = $this->getUserTable()->findByUsername($username,array('id'));
        $result = null;
        if($id){
            $user_table = $this->getUserTable()->getTable();
            $profile_table = $this->getUserProfileTable()->getTable();
            $query = "select $user_table.id,
                  $user_table.username,
                 $user_table.email,
                 $profile_table.first_name,
                 $profile_table.last_name,
                 $profile_table.user_id
                 from $user_table
                 join $profile_table on ($user_table.id = $profile_table.user_id )
                 where $user_table.username = '$username'
             ";
            $result = $this->getUserTable()->getDbAdapter()->query($query,Adapter::QUERY_MODE_EXECUTE);
        }
        return  is_object($result) ? $result->toArray() : $result;
    }
    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {

        $this->serviceLocator = $serviceLocator;

    }
    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @return mixed
     */
    public function getUserProfileTable()
    {
        return $this->getServiceLocator()->get('user_profile_Table');
    }
    /**
     * @return mixed
     */
    public function getUserTable()
    {
        return  $this->getServiceLocator()->get('user_Table');
    }

} 