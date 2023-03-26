<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountTransactionRequest;
use App\Http\Requests\UpdateAccountTransactionRequest;
use App\Models\AccountTransaction;

class AccountTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountTransaction $accountTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountTransaction $accountTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountTransactionRequest $request, AccountTransaction $accountTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountTransaction $accountTransaction)
    {
        //
    }
}
