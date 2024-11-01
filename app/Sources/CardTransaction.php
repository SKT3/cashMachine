<?php


namespace App\Sources;

use App\Interfaces\Transaction;
use Illuminate\Support\Facades\Validator;

class CardTransaction implements Transaction
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate()
    {
        $messages = [
            'required'  => 'Harap bagian :attribute di isi.',
            'unique'    => ':attribute sudah digunakan',
        ];
        // Define card validation rules
        return Validator::make($this->data, [
            'card_number' => 'required|string|digits:16|starts_with:4',
            'expiration_date' => 'required|date_format:m/Y|after:+' . now()->addMonths(2)->format('m/Y'),
            'cardholder' => 'required|string',
            'cvv' => 'required|digits:3',
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

