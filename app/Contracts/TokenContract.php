<?php

namespace App\Contracts;

interface TokenContract
{
    public function fetchAndStore(): void;
}
