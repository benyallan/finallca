<?php

return [
    'user' => [
        'user' => 'user',
        'users' => 'users',
        'columns' => [
            'email_verified_at' => 'Email verified at',
            'created_at' => 'Created at',
            'deleted_at' => 'Deleted at',
            'email' => 'E-mail',
            'name' => 'Name',
            'updated_at' => 'Updated at',
            'password' => 'Password',
        ],
    ],
    'person' => [
        'person' => 'person',
        'people' => 'people',
        'columns' => [
            'created_at' => 'Created at',
            'deleted_at' => 'Deleted at',
            'updated_at' => 'Updated at',
            'email' => 'E-mail',
            'name' => 'Name',
            'phone_number' => 'Phone number',
        ],
    ],
    'credit_card' => [
        'credit_card' => 'credit card',
        'credit_cards' => 'credit cards',
        'columns' => [
            'created_at' => 'Created at',
            'deleted_at' => 'Deleted at',
            'updated_at' => 'Updated at',
            'name' => 'Name',
            'description' => 'Description',
            'closing_day' => 'Closing day',
            'due_day' => 'Due day',
            'limit' => 'Limit',
            'direct_debit' => 'Direct debit',
        ],
    ],
    'bank' => [
        'bank' => 'bank',
        'banks' => 'banks',
        'columns' => [
            'created_at' => 'Created at',
            'deleted_at' => 'Deleted at',
            'updated_at' => 'Updated at',
            'number' => 'Number',
            'name' => 'Name',
        ],
    ],
    'account' => [
        'account' => 'account',
        'accounts' => 'accounts',
        'columns' => [
            'created_at' => 'Created at',
            'deleted_at' => 'Deleted at',
            'updated_at' => 'Updated at',
            'description' => 'Description',
            'opening_balance' => 'Opening balance',
            'balance' => 'Balance',
            'type' => 'Type',
            'number' => 'Number',
            'limit' => 'Limit',
            'income' => 'Income',
            'maintenance_fee' => 'Maintenance fee',
        ],
    ],
];
