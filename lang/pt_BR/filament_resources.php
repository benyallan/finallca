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
            'phone_number' => 'Telefone',
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
            'account_limit' => 'Limite',
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
            'income' => 'Com rendimento',
            'maintenance_fee' => 'Taxa de manutenção',
        ],
    ],
    'credit_card_transaction' => [
        'credit_card_transaction' => 'transação',
        'credit_card_transactions' => 'transações',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'description' => 'Descrição',
            'value' => 'Valor',
            'type' => 'Tipo',
            'date' => 'Data',
            'direction' => 'Direção',
            'status' => 'Status',
        ],
    ],
    'account_transaction' => [
        'account_transaction' => 'transação',
        'account_transactions' => 'transações',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'description' => 'Descrição',
            'value' => 'Valor',
            'type' => 'Tipo',
            'date' => 'Data',
            'direction' => 'Direção',
            'status' => 'Status',
        ],
    ],
];
