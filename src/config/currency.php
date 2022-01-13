<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | Models used in the User, Role and Permission CRUDs.
    |
    */

    'models' => [
        'products' => Backpack\Products\app\Models\Products::class,
        'promos' => Backpack\Products\app\Models\Promos::class,
        'sliders' => Backpack\Products\app\Models\Sliders::class,
        'messages' => Backpack\Products\app\Models\Messages::class,
        'sessions' => Backpack\Products\app\Models\Sessions::class,
        'categories' =>Backpack\Products\app\Models\Categories::class,
        'subcategories' =>Backpack\Products\app\Models\Subcategories::class,
        'colors' =>Backpack\Products\app\Models\Colors::class,
        'orders' =>Backpack\Products\app\Models\Orders::class,
        'discountcodes' => Backpack\Products\app\Models\DiscountCodes::class,
        

    ],

    /*
    |--------------------------------------------------------------------------
    | Disallow the user interface for creating/updating permissions or roles.
    |--------------------------------------------------------------------------
    | Roles and permissions are used in code by their name
    | - ex: $user->hasPermissionTo('edit articles');
    |
    | So after the developer has entered all permissions and roles, the administrator should either:
    | - not have access to the panels
    | or
    | - creating and updating should be disabled
    */

    'allow_permission_create' => true,
    'allow_permission_update' => true,
    'allow_permission_delete' => true,
    'allow_role_create'       => true,
    'allow_role_update'       => true,
    'allow_role_delete'       => true,

    /*
    |--------------------------------------------------------------------------
    | Multiple-guards functionality
    |--------------------------------------------------------------------------
    |
    */
    'multiple_guards' => false,

];
