<?php

return array(



'controllers' => array(
    //

    'invokables' => array(
        'Application\Controller\Index' => 'Application\Controller\IndexController',
        'Application\Controller\Home' => 'Application\Controller\HomeController',
    ),
),
  'router' => array(
    'routes' => array(
        'index' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'index'
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'usr_child' => array(
                    'type'    => 'Segment',
                    'options' => array(
                        'route'    => ':user[/]',
                        'constraints' => array(
                            'user'     => '[0-9]*[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action' => 'user',
                        ),
                    ),
                ),
            ),
        ),
        'user_home' => array(
            'type'    => 'Literal',
            'options' => array(
                'route'    => '/home',
                'defaults' => array(
                    'controller' => 'Application\Controller\Home',
                    'action' => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
            ),
        ),

    ),
  ),
);
