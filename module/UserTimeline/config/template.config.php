<?php
return array(

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'timeline/index' => __DIR__ . '/../view/user-timeline/index/index.phtml',
            'timeline/post_form' => __DIR__ . '/../view/user-timeline/index/_post_form.phtml'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),


    ),
    'asset_resolver' => array(
        'asset_directory' => '/st/tmln/',
    ),


);