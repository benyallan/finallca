<?php

return [
    'user' => [
        'user' => 'usuário',
        'users' => 'usuários',
        'columns' => [
            'email_verified_at' => 'E-mail verificado em',
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'email' => 'E-mail',
            'name' => 'Nome',
            'updated_at' => 'Última atualização',
            'password' => 'Senha',
        ],
    ],
    'person' => [
        'person' => 'Pessoa',
        'people' => 'Pessoas',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'email' => 'E-mail',
            'name' => 'Nome',
        ],
    ],
    'credit_card' => [
        'credit_card' => 'cartão de crédito',
        'credit_cards' => 'cartões de crédito',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'brand' => 'Bandeira',
            'description' => 'Descrição',
            'closing_day' => 'Dia de fechamento',
            'due_day' => 'Dia de vencimento',
            'credit_card_limit' => 'Limite',
            'direct_debit' => 'Débito automático',
        ],
    ],
    'bank' => [
        'bank' => 'banco',
        'banks' => 'bancos',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'number' => 'Número',
            'name' => 'Nome',
        ],
    ],
    'account' => [
        'account' => 'conta',
        'accounts' => 'contas',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'name' => 'Nome',
            'description' => 'Descrição',
            'opening_balance' => 'Saldo inicial',
            'balance' => 'Saldo',
            'type' => 'Tipo',
            'number' => 'Número',
            'account_limit' => 'Limite',
            'income' => 'Tem rendimento',
            'maintenance_fee' => 'Tarifa de manutenção de conta',
        ],
    ],
];
