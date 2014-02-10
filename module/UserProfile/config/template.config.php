<?php
return array(

    'view_manager' => array(

        'template_map' => array(

            'user-profile/login_form' =>  __DIR__ . '/../view/user-profile/user/_login_form.phtml',
            'user-profile/sign_form' =>  __DIR__ . '/../view/user-profile/user/_sign_form.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);