<?php 

return [
    [
        'label' => 'organization.menu.organizations',
        'route' => routeTo('crud/index',['table'=>'organizations']),
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-user-friends',
        'activeState' => [
            'organization.organizations',
        ]
    ],
    [
        'label' => 'organization.menu.positions',
        'route' => routeTo('crud/index',['table' => 'organization_positions']),
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-user-tie',
        'activeState' => [
            'organization.organization_positions',
        ]
    ],
    [
        'label' => 'organization.menu.member',
        'route' => routeTo('crud/index',['table' => 'organization_users']),
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-users',
        'activeState' => [
            'organization.organization_users',
        ]
    ],
    [
        'label' => 'organization.menu.presences',
        // 'route' => routeTo('crud/index',['table' => 'organization_users']),
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-clipboard-check',
        'activeState' => [
            'organization.organization_presences',
        ],
        'items' => [
            [
                'label' => 'organization.menu.attendances',
                'route' => routeTo('crud/index',['table' => 'organization_presences', 'filter' => ['record_type' => 'ATTENDANCE']]),
                'activeState' => 'organization.menu.attendances'
            ],
            [
                'label' => 'organization.menu.leaves',
                'route' => routeTo('crud/index',['table' => 'organization_presences', 'filter' => ['record_type' => 'LEAVES']]),
                'activeState' => 'organization.menu.leaves'
            ],
        ]
        
    ],
];