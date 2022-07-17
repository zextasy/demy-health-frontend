<?php

namespace App\Traits\Livewire;

use Illuminate\Support\Facades\Session;

trait ManipulatesCustomerSession
{

    private function setSessionCustomerIdentifier($value): void
    {
        Session::put('customerIdentifier', $value);
    }

    private function getSessionCustomerIdentifier(): string
    {
        if (auth()->user()){
            return auth()->user()->email;
        }

        return Session::get('customerIdentifier') ?? "";
    }
}
