<?php

namespace App\Services;

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
}
