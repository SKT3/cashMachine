<?php


namespace App\Sources;

use App\Interfaces\Transaction;
use App\Models\Transaction as Tra;

class CashMachine
{
    protected $transactions = [];

    /**
     * Store transaction in Database
     */
    public function store(Transaction $transaction)
    {
        // Check if limits are respected
        $totalProcessed = array_sum(array_map(fn($t) => $t->amount(), $this->transactions));

        if ($totalProcessed + $transaction->amount() > 20000) {
            return response()->json(['error' => 'Total processing limit exceeded.'], 404);
        }

        $validator = $transaction->validate();

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 404);
        }

        $data = new Tra();
        $data->total_amount = $transaction->amount();
        $data->input = json_encode($transaction->inputs());
        $data->save();

        return response()->json(['success' => $data], 200);
    }
}

