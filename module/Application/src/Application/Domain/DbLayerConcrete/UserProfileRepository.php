<?php
/**
 * 
 * User: Windows
 * Date: 2/6/14
 * Time: 12:55 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;


use Application\Domain\DbLayerInterfaces\RepositoryInterface;
use Application\Domain\DbLayerInterfaces\UserProfileRepositoryInterface;


class UserProfileRepository  extends GeneralRepository implements UserProfileRepositoryInterface {

    protected $table = "ribbit_user_profile";

    protected $general_repository;


    public function __construct(RepositoryInterface $repository){
          $this->general_repository = $repository;
    }

    function createProfile($user_id, $userdata = null)
    {
        if($userdata == null){

            $this->general_repository->AddTo($this->table,array('user_id'),$user_id);
        }else{
            $columns = array_keys($userdata);

            $this->general_repository->AddTo($this->table,$columns,$userdata);
        }
    }

    function findById($user_id, $columns = null)
    {
        return $this->general_repository->findBy(array('user_id' => $user_id),$this->table,$columns);

    }

    function findWhere($where = array(),$columns = array(), $limit = 1)
    {
        return $this->general_repository->findBy($where,$this->table,$columns);

    }

    function addUserData($data = array())
    {
        // TODO: Implement addUserData() method.
    }

    function updateProfile($dataToChange = array())
    {
        // TODO: Implement updateProfile() method.
    }

    function deleteUserProfile($user_id)
    {
        // TODO: Implement deleteUserProfile() method.
    }



}