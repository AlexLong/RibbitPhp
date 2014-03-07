<?php

return array(
    'view_manager' => array(

        'template_map' => array(),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        //'asset_directory' => $this->basePath() . '/st/tmln',
    ),
);