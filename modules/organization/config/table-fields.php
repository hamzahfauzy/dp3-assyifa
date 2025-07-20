<?php 

return [

    'organizations'  => [
        'parent_id' => [
            'label' => __('organization.label.parent'),
            'type'  => 'options-obj:organizations,id,name'
        ],
        'name' => [
            'label' => __('organization.label.name'),
            'type'  => 'text'
        ],
        'record_type' => [
            'label' => __('organization.label.record_type'),
            'type'  => 'text'
        ],
    ],

    'organization_users'  => [
        'organization_id' => [
            'label' => __('organization.label.organization'),
            'type'  => 'options-obj:organizations,id,name'
        ],
        'user_id' => [
            'label' => __('organization.label.user'),
            'type'  => 'options-obj:users,id,name'
        ],
        'role' => [
            'label' => __('organization.label.role'),
            'type'  => 'text'
        ],
    ],

    'organization_positions' => [
        'parent_id' => [
            'label' => __('organization.label.parent'),
            'type'  => 'options-obj:organization_positions,id,name'
        ],
        'name' => [
            'label' => __('organization.label.name'),
            'type'  => 'text'
        ],
        'record_type' => [
            'label' => __('organization.label.record_type'),
            'type'  => 'text'
        ],
    ],
    
    'organization_user_positions' => [
        'user_name' => [
            'label' => __('organization.label.user'),
            'type'  => 'text'
        ],
        'position_id' => [
            'label' => __('organization.label.position'),
            'type'  => 'options-obj:organization_positions,id,name'
        ],
        'start_at' => [
            'label' => __('organization.label.start_at'),
            'type'  => 'date'
        ],
        'end_at' => [
            'label' => __('organization.label.end_at'),
            'type'  => 'date'
        ],
    ],
    'organization_presences' => [
        'organization_id' => [
            'label' => __('organization.label.organization'),
            'type'  => 'options-obj:organizations,id,name'
        ],
        'user_id' => [
            'label' => __('organization.label.member'),
            'type'  => 'options-obj:users,id,name'
        ],
        'record_type' => [
            'label' => __('organization.label.record_type'),
            'type'  => 'options:ATTENDANCE|LEAVES'
        ],
        'description' => [
            'label' => __('organization.label.description'),
            'type'  => 'textarea'
        ],
        'start_at' => [
            'label' => __('organization.label.start_at'),
            'type'  => 'datetime-local'
        ],
        'end_at' => [
            'label' => __('organization.label.end_at'),
            'type'  => 'datetime-local'
        ],
    ],
    'organization_presence_media' => [
        'file' => [
            'label' => 'File',
            'type'  => 'file'
        ],
        'status' => [
            'label' => 'Status',
            'type'  => 'options:PURPOSE|CONFIRMED|REJECTED'
        ],
        'updated_by' => [
            'label' => __('organization.label.updated_by'),
            'type'  => 'options-obj:users,id,name'
        ]
    ]

];