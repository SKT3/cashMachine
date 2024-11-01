<?php


namespace App\Sources;


use App\Interfaces\Transaction;
use Illuminate\Support\Facades\Validator;

class BankTransaction implements Transaction
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate()
    {
        return Validator::make($this->data, [
            'transfer_date' => 'required|date|after_or_equal:' . now(),
            'customer_name' => 'required|string',
            'account_number' => 'required|string|size:6',
            'amount' => 'required|numeric|min:1|max:10000', // Adjust max as needed
        ]);
    }

    public function amount()
    {
        return $this->data['amount'];
    }

    public function inputs()
    {
        return $this->data;
    }
}

