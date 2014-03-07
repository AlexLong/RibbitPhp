<?php

return array(
    'cache' => array(
        'adapter' => array(
            'name' => 'filesystem',
            'options' => array(
                'cache_dir' => 'data/cache',
            ),
        ),
        'plugins' => array(
            array(
                'name' => 'serializer',
                'options' => array(
                )
            )
        )
    ),
);