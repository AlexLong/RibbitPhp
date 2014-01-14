<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 1:25 PM
 * 
 */

namespace Application\Domain\DbLayerInterfaces;

interface UserRepositoryInterface
{
    function  findById($id, array $columns = null);

    function  findByUsername($username, array $columns = null);

  public   function  findByEmail($email, array $columns = null);

}