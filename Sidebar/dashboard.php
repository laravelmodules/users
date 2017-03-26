<?php

\DashboardMenu::registerItem([
    'id' => 'Users',
    'priority' => 20,
    'parent_id' => null,
    'heading' => '',
    // 'heading' => 'Users',
    'title' => 'Users',
    'font_icon' => 'fa fa-bars',
    // 'link' => route('users.users.index.get'),
    'link' => '',
    'css_class' => null,
    'permissions' => ['view-menus']
]);

// \DashboardMenu::registerResource([
//      'parent' => 'Users', // Module Name
//      'prefix' => 'users', // Route prefix
//      'resource' => 'users', // Resouce name
//      'permissions' => 'view-backend', // Permissions Group
//      'priority' => 31, // priority Group
// ]);

// \MenuDashboard::registerItem([
//         'id' => route('users.users.index'),
//         'priority' => 1,
//         'parent_id' => 'Users',
//         'heading' => 'Claro',
//         'title' => 'Claro',
//         'font_icon' => 'fa fa-plus-circle',
//         'link' => route('users.users.index'),
//         // 'link' => '',
//         'css_class' => null,
//         'permissions' => 'view-backend'
// ]);

includeFiles(__DIR__.'/Dashboard/');
