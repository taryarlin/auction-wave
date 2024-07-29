<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class Controller
{
    public function customer(): Authenticatable
    {
        return auth()->guard('customer')->user();
    }
}
