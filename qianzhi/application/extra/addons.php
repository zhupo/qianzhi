<?php

return [
    'autoload' => false,
    'hooks' => [
        'upgrade' => [
            'cms',
        ],
        'app_init' => [
            'cms',
        ],
        'view_filter' => [
            'cms',
        ],
        'user_sidenav_after' => [
            'cms',
        ],
        'xunsearch_config_init' => [
            'cms',
        ],
        'xunsearch_index_reset' => [
            'cms',
        ],
        'wipecache_after' => [
            'tinymce',
        ],
        'set_tinymce' => [
            'tinymce',
        ],
    ],
    'route' => [
        '/$' => 'cms/index/index',
        '/t/[:name]$' => 'cms/tag/index',
        '/a/[:diyname]$' => 'cms/page/index',
        '/s$' => 'cms/search/index',
        '/d/[:diyname]$' => 'cms/diyform/index',
        '/d/[:diyname]/post' => 'cms/diyform/post',
        '/d/[:diyname]/[:id]' => 'cms/diyform/show',
        '/special/[:diyname]' => 'cms/special/index',
        '/[:diyname]$' => 'cms/channel/index',
        '/[:catename]/[:diyname]$' => 'cms/archives/index',
        '/u/[:id]' => 'cms/user/index',
    ],
    'priority' => [],
];
