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
                'user_repository' => function($sm){
                    $rep = new \UserProfile\Domain\DbLayerConcrete\UserRepository("ribbit_user",$sm->get('Zend\Db\Adapter\Adapter'));
                    return $rep;
                 },
                'user_profile_repository' => function($sm){
                 $rep = new  \UserProfile\Domain\DbLayerConcrete\UserProfileRepository("ribbit_user_profile",$sm->get('Zend\Db\Adapter\Adapter'));
                 return $rep;
                },
            )
        );
    }
}
