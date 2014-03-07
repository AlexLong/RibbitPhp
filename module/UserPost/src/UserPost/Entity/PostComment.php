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

    public $post_id;

    public $parent_id;

    public $user_id;

    public $comment_date;

    public $comment_content;

    public $comment_image;

} 