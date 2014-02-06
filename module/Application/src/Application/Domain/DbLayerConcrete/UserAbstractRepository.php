<?php
/**
 * 
 * User: Windows
 * Date: 2/6/14
 * Time: 3:01 PM
 * 
 */

namespace Application\Domain\DbLayerConcrete;


use Application\Domain\DbLayerInterfaces\RepositoryInterface;

class UserAbstractRepository {

    protected  $general_repository;

    protected $table = null;

    public function __construct(RepositoryInterface $repsitory){
        $this->general_repository = $repsitory;
    }



} 