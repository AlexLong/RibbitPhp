<?php
/**
 * 
 * User: Windows
 * Date: 2/6/14
 * Time: 12:55 PM
 * 
 */

namespace Application\Domain\DbLayerInterfaces;


interface UserProfileRepositoryInterface extends RepositoryInterface {



    function createProfile($user_id, $userdata = null);

    function findById($user_id, $columns = array());

    function findWhere($where = array(),$columns = array(), $limit = 1);

    function addUserData($data = array());

    function updateProfile($dataToChange = array());

    function deleteUserProfile($user_id);

} 