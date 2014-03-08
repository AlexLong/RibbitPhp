<?php
namespace UserProfile;



use UserProfile\Service\ProfileCacheService;
use Zend\Config\Config;

class Module
{
    public function getConfig()
    {
        $conf = array_merge_recursive(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/routes.config.php',
            include __DIR__ . '/config/template.config.php'
        );
        return new Config($conf);
    }


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(),
            'factories' => array(),
        );
    }


    public  function  getServiceConfig(){
        return array(
            'invokables' => array(

            ),
            'factories' => array(
                'userAggregate' => 'UserProfile\Domain\Concrete\UserAggregateFactory',
                'profileCacheService' => function($sm){
                      $userProfileCache = new ProfileCacheService();
                      $userProfileCache->setServiceLocator($sm);
                      $userProfileCache->setCacheService($sm->get('GlobalCacheService'));
                      $userProfileCache->setNamespace("user_profile_");
                      return $userProfileCache;
                 },
                'UserProfileService' => function($sm){
                        $user_service = new \UserProfile\Service\UserProfileService();
                        $user_service->setProfileCacheService($sm->get('profileCacheService'));
                        $user_service->setServiceLocator($sm);
                        return $user_service;
                },



            )
        );
    }
}
