<?php
return array(


    'view_manager' => array(

        'template_map' => array(
            'user-auc/login_form' =>  __DIR__ . '/../view/user-auc/index/_login_form.phtml',
            'user-auc/sign_form' =>  __DIR__ . '/../view/user-auc/index/_sign_form.phtml',
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