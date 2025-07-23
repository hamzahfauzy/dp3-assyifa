<?php

$fields['indicator_id']['type'] = 'options:- Pilih Parameter -';

$fields['users'] = [
    'label' => 'Pelaksana',
    'type' => 'options-obj:users,id,name',
    'attr' => [
        'multiple' => true
    ]
];

return $fields;