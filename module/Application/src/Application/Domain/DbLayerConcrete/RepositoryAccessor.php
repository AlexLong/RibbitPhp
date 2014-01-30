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

    /**
     * @var \Application\Domain\DbLayerInterfaces\RepositoryInterface
     */
    protected $general_repository;

    /**
     * @var UserRepository
     */
    public  $users;

    /**
     * @param RepositoryInterface $general
     */
    public  function __construct(RepositoryInterface $general)
    {

        $this->general_repository = $general;
        $this->users = new UserRepository($this->general_repository);
    }

}