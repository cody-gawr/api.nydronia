<?php

namespace App\Contracts;

interface TokenContract
{
    public function fetchAndStore(): void;
    public function getPrice(string $tokenAddress): array;
}
