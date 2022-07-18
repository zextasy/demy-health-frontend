<?php

namespace App\Traits\Livewire;

use Illuminate\Support\Facades\Session;

trait ManipulatesCustomerSession
{

    protected function setToSession($key, $value): void
    {
        if (empty($value)){
            return;
        }
        Session::put($key, $value);
    }

    protected function setSessionCustomerEmail($value): void
    {
        if (empty($value)){
            return;
        }
        Session::put('customerEmail', $value);
    }

    protected function setSessionCustomerIdentifier($value): void
    {
        if (empty($value)){
            return;
        }
        Session::put('customerIdentifier', $value);
    }

    protected function getFromSession(string $key): string
    {

        return Session::get($key) ?? "";
    }

    protected function getSessionCustomerIdentifier(): string
    {
        if (!empty($this->getSessionCustomerEmail())){
            return $this->getSessionCustomerEmail();
        }

        return Session::get('customerIdentifier') ?? "";
    }

    protected function getSessionCustomerEmail(): string
    {
        if (auth()->user()){
            return auth()->user()->email;
        }

        return Session::get('customerEmail') ?? "";
    }
}
