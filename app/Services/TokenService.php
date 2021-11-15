<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use App\Contracts\TokenContract;
use App\Repositories\{
    TokenRepositoryInterface,
};

class TokenService implements TokenContract
{
    /**
     * @var TokenRepositoryInterface $tokenRepository
     */
    protected $tokenRepository;

    public function __construct(
        TokenRepositoryInterface $tokenRepository
    ) {
        $this->tokenRepository = $tokenRepository;
    }

    public function fetchAndStore(): void
    {
        $tokens = $this->tokenRepository->fetch();
        $this->tokenRepository->store($tokens);
    }

    public function getPrice(string $tokenAddress): array
    {
        $endpoint = 'https://api.coingecko.com/api/v3/simple/price';
        $token = $this->tokenRepository->findOrFailByTokenAddress($tokenAddress);
        $response = Http::get($endpoint, [
            'ids' => $token->token_id,
            'vs_currencies' => 'usd',
            'include_market_cap' => 'true',
            'include_24hr_vol' => 'true',
            'include_24hr_change' => 'true',
            'include_last_updated_at' => 'true'
        ]);

        return $response->json();
    }
}
