<?php

return array(



'controllers' => array(
    //

    'invokables' => array(
        'Application\Controller\Index' => 'Application\Controller\IndexController',
        'Application\Controller\Home' => 'Application\Controller\HomeController'
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
                'index_child' => array(
                    'type'    => 'Segment',
                    'options' => array(
                        'route'    => ':action',
                        'constraints' => array(
                            'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                        'defaults' => array(

                        ),
                    ),
                ), // End index_child
              //  'query' => array('type' => 'query'),


            ),
        ), // End Application
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




        /*
          'application' => array(
              'type'    => 'Literal',
              'options' => array(
                  'route'    => '/application',
                  'defaults' => array(
                      '__NAMESPACE__' => 'Application\Controller',
                      'controller'    => 'Index',
                      'action'        => 'index',
                  ),
              ),
              'may_terminate' => true,
              'child_routes' => array(
                  'default' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/[:controller[/:action]]',
                          'constraints' => array(
                              'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                              'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                          ),
                          'defaults' => array(

                          ),
                      ),
                  ),
              ),
          ),

          */

    ),
  ),
);
