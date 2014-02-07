<?php

return array(



'controllers' => array(
    //

    'invokables' => array(
        'Application\Controller\Index' => 'Application\Controller\IndexController',
        'Application\Controller\Home' => 'Application\Controller\HomeController',
        'Application\Controller\User' => 'Application\Controller\UserController',
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
                            'user'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action' => 'index',
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
        'u' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/u',
                'defaults' => array(
                    'controller' => 'Application\Controller\User',
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
                            'controller' => 'Application\Controller\User',
                            'action' => 'index',
                        ),
                    ),
                ),
            ),
        ), // End User

    ),
  ),
);
