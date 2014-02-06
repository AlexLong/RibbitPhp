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



    function createProfile($userData = array());

    function findById($user_id,array $columns = null );

    function updateProfile($dataToChange = array(), $where = array());

    function deleteUserProfile($user_id);

} 