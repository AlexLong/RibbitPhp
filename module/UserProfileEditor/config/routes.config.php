<?php
return array(

    'controllers' => array(
        'invokables' => array(

            'UserProfileEditor\Controller\Index' => 'UserProfileEditor\Controller\IndexController'
        )
    ),
    'router' => array(
        'routes' => array(
            'private_profile' => array(
                'type' => 'Literal',
                'priority' => 1000,
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
                    'prof_edit_child' => array(
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