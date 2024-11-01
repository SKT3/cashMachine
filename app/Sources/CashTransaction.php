<?php


namespace App\Sources;


use App\Interfaces\Transaction;
use Illuminate\Support\Facades\Validator;

class CashTransaction implements Transaction
{
    protected $banknotes;
    protected $totalAmount;

    public function __construct($banknotes)
    {
        $this->banknotes = $banknotes;
    }

    public function validate()
    {
        // Example validation rules can be defined here
        return Validator::make($this->banknotes, [
            '1' => 'integer|min:0|max:5', // Quantity for each banknote
            '5' => 'integer|min:0|max:5',
            '10' => 'integer|min:0|max:5',
            '50' => 'integer|min:0|max:5',
            '100' => 'integer|min:0|max:5',
        ]);
    }

    public function amount()
    {
        $this->totalAmount = ($this->banknotes['1'] * 1) +
            ($this->banknotes['5'] * 5) +
            ($this->banknotes['10'] * 10) +
            ($this->banknotes['50'] * 50) +
            ($this->banknotes['100'] * 100);

        return $this->totalAmount;
    }

    public function inputs()
    {
        return $this->banknotes;
    }
}

