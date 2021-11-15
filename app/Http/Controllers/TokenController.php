<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    //
    public function getPrice(string $tokenAddress)
    {
        return $this->apiReply($tokenAddress);
    }
}
