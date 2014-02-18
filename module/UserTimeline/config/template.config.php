<?php
return array(

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'timeline/index' => __DIR__ . '/../view/user-timeline/index/index.phtml',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

    )

);