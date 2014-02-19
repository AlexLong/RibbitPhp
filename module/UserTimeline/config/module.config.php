<?php
return array(

    'controllers' => array(
        'invokables' => array(
            'UserTimeline\Controller\Index' => 'UserTimeline\Controller\IndexController',

        ),
    ),

    'router' => array(
        'routes' => array(
            'timeline' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/tmln',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'UserTimeline\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(

                    'tmln_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'UserTimeline\Controller\Index',
                                'action' => 'index',
                            ),

                        ),
                    ),

                ),
            ),
        )
    ), // End User

);