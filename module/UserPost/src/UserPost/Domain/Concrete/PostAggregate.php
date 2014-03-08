<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 3:49 PM
 * 
 */

namespace UserPost\src\UserPost\Domain\Concrete;


use Application\Domain\Concrete\AbstractDbAggregate;
use UserPost\src\UserPost\Entity\PostEntity;

class PostAggregate extends AbstractDbAggregate{

    protected $post;

    protected $tables = array(
        'post' => 'ribbit_post',
        'post_comments' => 'ribbit_post_comment',

    );

    /**
     * @return PostTable
     */
    public function getPost()
    {
        if(!$this->post){

            $this->post = new PostTable($this->tables['post'],$this->dbAdapter, new PostEntity());
        }
        return $this->post;
    }




} 