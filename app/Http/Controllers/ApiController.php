<?php

namespace App\Http\Controllers;
use Illuminate\Auth\AuthenticationException;
use App\Http\Traits\ApiResponses;

abstract class ApiController
{
    use ApiResponses;

    public function __construct()
    {
    }
}
