<?php
/**
 * 
 * User: Windows
 * Date: 3/6/14
 * Time: 10:18 PM
 * 
 */

namespace UserPost\src\UserPost\Entity;


use Application\Entity\AbstractEntity;

class UserPost extends AbstractEntity{

    public $post_id = null;

    public $post_content = null;

    public $post_date = null;

    public $post_picture = null;

    public $user_id = null;

    public $vcl_mode = 0;

} 