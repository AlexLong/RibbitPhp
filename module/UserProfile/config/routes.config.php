<?php
return array(
    'controllers' => array(

        'invokables' => array(
          'UserProfile\Controller\UserAuth' => 'UserProfile\Controller\UserAuthController',
          'UserProfile\Controller\UserRest' => 'UserProfile\Controller\UserRestController',
          'UserProfile\Controller\UserProfile' => 'UserProfile\Controller\UserProfileController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'u' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/u',
                    'defaults' => array(
                        'controller' => 'UserProfile\Controller\UserAuth',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'u_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'UserProfile\Controller\UserAuth',
                                'action' => 'index',
                            ),

                        ),
                    ),
                ),
            ), // End User
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