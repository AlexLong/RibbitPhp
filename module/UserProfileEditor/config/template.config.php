<?php

return array(
    'view_manager' => array(

        'template_map' => array(
            'profile_editor/profile_form' =>  __DIR__ . '/../view/user-profile-editor/index/_profile_form.phtml',
            'profile_editor/picture_form' =>  __DIR__ . '/../view/user-profile-editor/index/_profile_picture.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
            'ImageStrategy'
        ),
        //'asset_directory' => $this->basePath() . '/st/tmln',
    ),
);