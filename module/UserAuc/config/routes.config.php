<?php
return array(

    'controllers' => array(
        'invokables' => array(
            'UserAuc\Controller\Index' => 'UserAuc\Controller\IndexController',
        ),
    ),

    'user_links' => array(
        'login_form' =>  array(
            'route' => 'auc/auc_child',
            'action' => 'login'
        ),
    ),
    'router' => array(
        'routes' => array(

            'auc' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/auc',
                    'defaults' => array(
                        'controller' => 'UserAuc\Controller\Index',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'auc_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'UserAuc\Controller\Index',
                                'action' => 'index',
                            ),

                        ),
                    ),
                ),
            ), // End User

        ),
    )
);