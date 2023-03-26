<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreditCardTransactionRequest;
use App\Http\Requests\UpdateCreditCardTransactionRequest;
use App\Models\CreditCardTransaction;

class CreditCardTransactionController extends Controller
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
    public function store(StoreCreditCardTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditCardTransaction $creditCardTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CreditCardTransaction $creditCardTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCreditCardTransactionRequest $request, CreditCardTransaction $creditCardTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditCardTransaction $creditCardTransaction)
    {
        //
    }
}
