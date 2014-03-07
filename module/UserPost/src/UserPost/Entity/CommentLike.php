<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 2:48 PM
 * 
 */

namespace UserPost\src\UserPost\Entity;


use Application\Entity\AbstractEntity;

class CommentLike extends AbstractEntity{

    public $comment_id = null;

    public $user_id = null;

    public $like_date = null;
} 