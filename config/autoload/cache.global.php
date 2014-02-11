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
                'name' => 'Serializer',
                'options' => array(
                )
            )
        ),
        'options' => array(
            'namespace' => 'global_cache',
            'ttl' => 3600*24*30
        )
    ),

);