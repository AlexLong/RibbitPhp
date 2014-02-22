<?php

return array(
    'view_manager' => array(

        'template_map' => array(
            'profile_editor/profile' =>  __DIR__ . '/../view/user-profile-editor/index/_profile_form.phtml',

        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        //'asset_directory' => $this->basePath() . '/st/tmln',
    ),
);