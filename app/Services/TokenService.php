<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Contracts\TokenContract;
use App\Repositories\{
    TokenRepositoryInterface,
};
use Illuminate\Http\Client\Pool;

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
        $tokenAddress = Str::lower($tokenAddress);
        if (Cache::has("price_$tokenAddress")) {
            return Cache::get("price_$tokenAddress");
        }

        $endpoint = 'https://api.coingecko.com/api/v3/simple/price';
        $token = $this->tokenRepository->findOrFailByTokenAddress($tokenAddress);
        $binanceNativeToken = $this->tokenRepository->findOrFailBySymbol('bnb');
        $response = Http::get($endpoint, [
            'ids' => join(',', [$binanceNativeToken->token_id, $token->token_id]),
            'vs_currencies' => 'usd',
            'include_market_cap' => 'true',
            'include_24hr_vol' => 'true',
            'include_24hr_change' => 'true',
            'include_last_updated_at' => 'true'
        ]);

        if ($response->ok()) {
            $priceResponse = $response->json();
            $tokenPriceInfo = $priceResponse[$token->token_id];
            $binanceNativeTokenPriceInfo = $priceResponse[$binanceNativeToken->token_id];
            $result = array_merge(
                [
                    'updated_at' => $tokenPriceInfo['last_updated_at'],
                    'price' => $tokenPriceInfo['usd'],
                    'price_24h_change' => $tokenPriceInfo['usd_24h_change'],
                    'price_bnb' => $tokenPriceInfo['usd'] / $binanceNativeTokenPriceInfo['usd']
                ],
                $token->only(['name', 'symbol', 'token_address'])
            );
            Cache::put("price_$tokenAddress", $result, 30);
            return $result;
        } else {
            throw new HttpException(400, 'Coingecko error');
        }
    }
}
