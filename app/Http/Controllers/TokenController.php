<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\TokenContract;

class TokenController extends Controller
{
    //
    public function getPrice(string $tokenAddress, TokenContract $contract)
    {
        return $this->apiReply(
            $contract->getPrice($tokenAddress)
        );
    }
}
