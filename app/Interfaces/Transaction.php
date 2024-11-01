<?php

namespace App\Interfaces;


interface Transaction{
    public function validate();
    public function amount();
    public function inputs();

}
