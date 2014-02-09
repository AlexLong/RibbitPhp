<?php
/**
 * 
 * User: Windows
 * Date: 2/7/14
 * Time: 5:44 PM
 * 
 */

namespace Application\Domain\DbLayerInterfaces;


use Application\Domain\DbLayerInterfaces\RepositoryInterface;

interface UserProfileRepositoryInterface extends  RepositoryInterface {

    function createProfile($userData = array());

    function findById($user_id,array $columns = null );

    function updateProfile($dataToChange = array(), $where = array());

    function deleteUserProfile($user_id);

} 