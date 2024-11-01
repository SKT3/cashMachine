<?php


namespace App\Sources;

use App\Sources\BankTransaction;
use App\Sources\CardTransaction;
use App\Sources\CashTransaction;
use Illuminate\Http\Request;

class TransactionFactory
{
    public static function make(string $type, Request $request){
        switch ($type){
            case CashTransaction::class:
                return new CashTransaction($request->all());
                break;
            case BankTransaction::class:
                return new BankTransaction($request->all());
                break;
            case CardTransaction::class:
                return new CardTransaction($request->all());
                break;
        }
    }
}
