<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 1:18 AM
 * 
 */

namespace UserPost\src\UserPost\Entity;
use Application\Entity\AbstractEntity;

class PostComment extends AbstractEntity {

    public $id = null;


    public $post_id = null;

    public $parent_id = null;

    public $user_id = null;

    public $comment_date = null;

    public $comment_content = null;

    public $comment_image = null;

} 