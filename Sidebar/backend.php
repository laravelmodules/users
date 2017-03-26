<?php

\BackendMenu::registerItem([
    'id' => 'Users',
    'priority' => 1,
    'parent_id' => null,
    'heading' => trans('menus.backend.sidebar.system'),
    // 'heading' => 'Users',
    'title' => __('Users'),
    // 'title' => trans('menus.backend.access.title'),
    'font_icon' => 'fa fa-users',
    // 'link' => route('users::menus.index.get'),
    'link' => '',
    'css_class' => null,
    'permissions' => 'view-backend'
]);
\BackendMenu::registerItem([
    'id' => 'Users-manage',
    'priority' => 1.2,
    'parent_id' => 'Users',
    'heading' => '',
    // 'heading' => 'Users',
    'title' => trans('labels.backend.access.users.management'),
    'font_icon' => 'fa fa-circle-o',
    'link' => route('admin.access.user.index'),
    // 'link' => '',
    'css_class' => null,
    'permissions' => 'manage-users'
]);
\BackendMenu::registerItem([
    'id' => 'Users-manage-roles',
    'priority' => 1.3,
    'parent_id' => 'Users',
    'heading' => '',
    // 'heading' => 'Users',
    'title' => trans('labels.backend.access.roles.management'),
    'font_icon' => 'fa fa-circle-o',
    'link' => route('admin.access.role.index'),
    // 'link' => '',
    'css_class' => null,
    'permissions' => 'manage-roles'
]);

// \BackendMenu::registerItem([
//     'id' => 'Users-manage',
//     'priority' => 20,
//     'parent_id' => 'Users',
//     'heading' => trans('menus.backend.sidebar.system'),
//     // 'heading' => 'Users',
//     'title' => trans('menus.backend.access.title'),
//     'font_icon' => 'fa fa-bars',
//     // 'link' => route('users::menus.index.get'),
//     'link' => '',
//     'css_class' => null,
//     'permissions' => ['manage-users', 'manage-roles']
// ]);

// \BackendMenu::registerResource([
//      'parent' => 'Users', // Module Name
//      'prefix' => 'users', // Route prefix
//      'resource' => 'users', // Resouce name
//      'permissions' => 'view-backend', // Permissions Group
//      'priority' => 31, // priority Group
// ]);

// \BackendMenu::registerItem([
//         'id' => route('Users.usuario.index'),
//         'priority' => 1,
//         'parent_id' => 'Users',
//         'heading' => 'Claro',
//         'title' => 'Claro',
//         'font_icon' => 'fa fa-plus-circle',
//         'link' => route('Users.usuario.index'),
//         // 'link' => '',
//         'css_class' => null,
//         'permissions' => 'view-backend'
// ]);

includeFiles(__DIR__.'/Backend/');
