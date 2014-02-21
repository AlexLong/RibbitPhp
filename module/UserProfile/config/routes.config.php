<?php

return array(

    'controllers' => array(
        'invokables' => array(
            'UserProfile\Controller\Index' => 'UserProfile\Controller\IndexController',
            'UserProfile\Controller\UserRest' => 'UserProfile\Controller\UserRestController',
            'UserProfile\Controller\Profile' => 'UserProfile\Controller\ProfileController',

        ),
    ),
    'router' => array(
        'routes' => array(
            'private_profile' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route'    => '/prof',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'UserProfile\Controller\Profile',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'profile_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'UserProfile\Controller\Profile',
                                'action' => 'index',
                            ),

                        ),
                    ),

                ),
            ),


            'user_profile' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route'    => '/v',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'UserProfile\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'profile_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:user[/]',
                            'constraints' => array(
                                'user'     => '[0-9]*[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'UserProfile\Controller\Index',
                                'action' => 'user',
                            ),

                        ),
                    ),
                    'profile_action' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:user/:action[/]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'UserProfile\Controller\Index',
                                'action' => 'user',
                            ),

                        ),
                    ),
                ),
            ),



            'profile-rest' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/user_api/[:user][.:format][/]',
                    'defaults' => array(
                        'controller' => 'UserProfile\Controller\UserRest',

                        'constraints' => array(
                            'user'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'format' => 'json'
                        ),
                    ),


                ),

            ),

        )
    )

);