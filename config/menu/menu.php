<?php return [
    'main_menu' => [
        'Dashboard' => [
            'icon' => 'ti-dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'route' => 'admin.dashboard',
                    'icon'  => 'dashboard',
                    'permission' => 'dashboard',
                ],
            ]
        ],
        'Users' => [
            'icon' => 'ti-users',
            'items' => [
                [
                    'title' => 'Users',
                    'route' => 'admin.user-index',
                    'icon'  => 'user',
                    'permission' => 'user-list',
                ],
                [
                    'title' => 'Manage Roles',
                    'route' => 'admin.roles-index',
                    'icon'  => 'shield',
                    'permission' => 'user-roles-list',
                ],
                [
                    'title' => 'Manage Permissions',
                    'route' => 'admin.perm-index',
                    'icon'  => 'lock',
                    'permission' => 'user-permissions-list',
                ],
            ],
        ],

        'Pages' => [
            'icon' => 'ti-book',
            'items' => [
                [
                    'title' => 'Pages',
                    'route' => 'pages.index',
                    'icon'  => 'book',
                    'permission' => 'page-list',
                ],
            ]
        ],
        'Seo' => [
            'icon' => 'ti-seo',
            'items' => [
                [
                    'title' => 'Blogs',
                    'route' => 'seo.blogs.index',
                    'icon'  => 'list-details',
                    'permission' => 'blog-list',
                ],
                [
                    'title' => 'Comments',
                    'route' => 'seo.blogs.comments',
                    'icon'  => 'messages',
                    'permission' => 'blogs-comment',
                ],
                [
                    'title' => 'Seo',
                    'route' => 'seo.index',
                    'icon'  => 'seo',
                    'permission' => 'seo-index',
                ],
                [
                    'title' => 'Testimonial',
                    'route' => 'admin.testimonials',
                    'icon'  => 'message-star',
                    'permission' => 'testimonial-list',
                ],
            ]
        ],
        'Menu' => [
            'icon' => 'ti-menu-2',
            'items' => [
                [
                    'title' => 'Menu',
                    'route' => 'menus.index',
                    'icon'  => 'ti-menu-2',
                    'permission' => 'menu-list',
                ],
            ]
        ],
        'Website Settings' => [
            'icon' => 'ti-settings',
            'items' => [
                [
                    'title' => 'Settings',
                    'route' => 'admin.settings',
                    'icon'  => 'ti-settings',
                    'permission' => 'website-settings',
                ],
            ]
        ],
        'Contact Messages' => [
            'icon' => 'ti-bubble-text',
            'items' => [
                [
                    'title' => 'Contact Messages',
                    'route' => 'admin.contacts',
                    'icon'  => 'ti-bubble-text',
                    'permission' => 'contacts-list',
                ],
            ]
        ],
        // 'File Manager' => [
        //     'icon' => 'ti-folder',
        //     'items' => [
        //         [
        //             'title' => 'File Manager',
        //             'route' => 'file-manager',
        //             'icon'  => 'folder',
        //             'permission' => 'file-manager',
        //         ],
        //     ]
        // ]
    ]
];
