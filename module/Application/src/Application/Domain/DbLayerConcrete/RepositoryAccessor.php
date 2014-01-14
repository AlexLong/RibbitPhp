<?php
/**
 * 
 * User: Windows
 * Date: 1/9/14
 * Time: 5:29 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;


use Application\Domain\DbLayerInterfaces\RepositoryInterface;


class RepositoryAccessor {

    protected $general_repository;
    public  $users;

    public  function __construct(RepositoryInterface $general)
    {
        $this->general_repository = $general;
        $this->users = new UserRepository($this->general_repository);
    }
}