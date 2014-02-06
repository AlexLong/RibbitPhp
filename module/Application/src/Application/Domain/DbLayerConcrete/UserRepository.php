<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:34 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;



use Application\Domain\DbLayerInterfaces\UserProfileRepositoryInterface;
use Application\Domain\DbLayerInterfaces\UserRepositoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserRepository extends AbstractRepository implements  UserRepositoryInterface, ServiceLocatorAwareInterface {


    protected $table = 'ribbit_user';

    protected $userProfile;


    protected $insert_columns = array('email', 'username', 'password',
        'registration_date', 'role');

    public function __construct(ServiceLocatorInterface $sm){
        parent::__construct($sm);
    }
    function  findById($id, array $columns = null)
    {
         return $this->findBy(array('id' => $id),$columns);
    }
    function  findByUsername($username, array $columns = null)
    {
        return $this->findBy(array('username' => $username),$columns);
    }
    function  findByEmail($email, array $columns = null)
    {
        return $this->findBy(array('email' => $email),$columns);
    }

    function createUser($values = array())
    {
        foreach($values as $key => $v)
        {
            if(!in_array($key,$this->insert_columns))
                unset($values[$key]);
        }
        if(array_key_exists('password',$values)){
            $values['password'] = md5($values['password']);
        }
        $values['registration_date'] = date("Y-m-d H:i:s");

      return $this->addTo($values);
    }

    function dropById($userId)
    {

    if(!$this->findById($userId, array('id'))) return false;

        $statement = array();
        $statement[] = $this->getSqlManager()->delete($this->table)->where(array('id' => $userId));
        $statement[] = $this->getUserProfile()->deleteUserProfile($userId);
        $this->execute($statement);
     return  true;
    
    }
    /**
     * @param mixed $userProfile
     */
    public function setUserProfile(UserProfileRepositoryInterface $userProfile)
    {
        $this->userProfile = $userProfile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserProfile()
    {
        if(!$this->userProfile){
            $this->setUserProfile(new UserProfileRepository($this->getServiceLocator()));
        }

        return $this->userProfile;
    }




} 