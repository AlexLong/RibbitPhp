<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 3:51 PM
 * 
 */

namespace UserPost\src\UserPost\Domain\Concrete;


use Application\Domain\Concrete\AbstractTable;
use UserPost\src\UserPost\Entity\PostEntity;
use Zend\Db\Adapter\AdapterInterface;

class PostTable extends AbstractTable{


    public function __construct($table,AdapterInterface $adapter, PostEntity $user_profile){
        parent::__construct($table,$adapter);
        $this->entity = $user_profile;
    }



} 