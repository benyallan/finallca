<?php

return [
    'user' => [
        'user' => 'Usuário',
        'users' => 'Usuários',
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
        'credit_card' => 'Cartão de crédito',
        'credit_cards' => 'Cartões de crédito',
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
        'bank' => 'Banco',
        'banks' => 'Bancos',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'number' => 'Número',
            'name' => 'Nome',
        ],
    ],
    'account' => [
        'account' => 'Conta bancária',
        'accounts' => 'Contas bancárias',
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
    'transaction' => [
        'transaction' => 'Transação',
        'transactions' => 'Transações',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'date' => 'Data',
            'currency_code' => 'Código da moeda',
            'transaction_amount' => 'Valor da transação',
            'description' => 'Descrição',
            'direction' => [
                'direction' => 'Operação',
                'in' => 'Crédito',
                'out' => 'Débito',
            ],
            'related_transaction_id' => 'Transferência para',
            'accountable' => 'Local',
            'accountable_from' => 'Transação de: ',
            'accountable_to' => 'Transação para: ',
            'done' => 'Concluída',
        ],
        'actions' => [
            'transfer' => 'Transferência',
        ],
        'done' => 'Concluída',
        'done' => [
            'yes' => 'Sim',
            'no' => 'Não',
        ],
    ],
    'wallet' => [
        'wallet' => 'Carteira',
        'wallets' => 'Carteiras',
        'columns' => [
            'created_at' => 'Criado em',
            'deleted_at' => 'Excluído em',
            'updated_at' => 'Última atualização',
            'description' => 'Descrição',
            'balance' => 'Saldo',
            'opening_balance' => 'Saldo inicial',
            'person_id' => 'Pessoa',
        ],
    ],
];
