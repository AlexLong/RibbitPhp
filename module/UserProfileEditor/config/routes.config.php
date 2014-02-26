<?php
return array(

    'controllers' => array(
        'invokables' => array(

            'UserProfileEditor\Controller\Index' => 'UserProfileEditor\Controller\IndexController',
            'UserProfileEditor\Controller\ProfileAsset' => 'UserProfileEditor\Controller\ProfileAssetController',
        )
    ),
    'router' => array(
        'routes' => array(
            'prof_asset' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/asset',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'UserProfileEditor\Controller\ProfileAsset',

                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'profile_img' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Regex',
                        'options' => array(
                         //   'route'    => '/profile_image/:user_id/:picture_name[]',
                            'regex' => '/(?<user_id>(\d+))/profile_image/(?<pic_name>[a-zA-Z0-9_-]+)(\.(?<format>(jpg|png|gift)))',
                            'defaults' => array(
                                'controller' => 'UserProfileEditor\Controller\ProfileAsset',
                                'action' => 'profileImg',
                                'format' => 'jpg'
                            ),
                            'spec' => '/%user_id%/profile_image/%pic_name%.%format%',
                        ),
                    ),
                ),
            ),

            'private_profile' => array(
                'type' => 'Literal',

                'options' => array(
                    'route'    => '/edit',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'UserProfileEditor\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'p_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'UserProfileEditor\Controller\Index',
                                'action' => 'index',
                            ),

                        ),
                    ),
                ),
            ),

        ),
    ),
);