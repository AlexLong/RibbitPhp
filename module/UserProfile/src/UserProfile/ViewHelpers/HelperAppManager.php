<?php
/**
 * 
 * User: Windows
 * Date: 1/19/14
 * Time: 11:14 AM
 * 
 */

namespace UserProfile\ViewHelpers;


use Zend\ServiceManager\Exception;
use Zend\View\HelperPluginManager;

class HelperAppManager extends  HelperPluginManager{

    protected $factories = array(
        'userIdentity'       => 'UserProfile\ViewHelpers\Service\UserIdentityFactory'
    );
} 