<?php

namespace App\Http\Controllers;

use App\Sources\TransactionFactory;
use App\Sources\CashMachine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController
{
    protected $cashMachine;

    public function __construct(CashMachine $cashMachine)
    {
        $this->cashMachine = $cashMachine;
    }

    public function processTransaction(Request $request, string $type)
    {
        $transaction = TransactionFactory::make($type, $request);

        return $this->cashMachine->store($transaction);

    }
}


