<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use Util;
use App\Models\{
    BaseModel,
    Token
};

class TokenRepository extends BaseRepository implements TokenRepositoryInterface
{
    /**
     * TokenRepository constructor.
     *
     * @param Token $model
     * @return void
     */
    public function __construct(Token $model)
    {
        parent::__construct($model);
    }

    /**
     * @param void
     * @return \Illuminate\Support\Collection
     */
    public function fetch(): \Illuminate\Support\Collection
    {
        $tokens = collect();
        $endpoint = 'https://api.coingecko.com/api/v3/coins/list';
        $response = Http::get($endpoint, [
            'include_platform' => true
        ]);
        collect($response->json())->each(function ($item) use ($tokens) {
            foreach ($item['platforms'] as $chain => $contractAddress) {
                if (empty($chain) || empty($tokenAddress)) {
                    continue;
                }
                $tokens->push(
                    array_merge(
                        collect($item)->except(['id', 'platforms'])->all(),
                        [
                            'token_id' => $item['id'],
                            'chain' => $chain,
                            'contract_address' => $contractAddress
                        ]
                    )
                );
            }
        });
        return $tokens;
    }

    public function findByContractAddress(string $contractAddress): ?Token
    {
        return $this->model->whereRaw('lower(contract_address) = ?', Str::lower($contractAddress))->first();
    }

    public function getTokensByChain(string $chain): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->ofChain($chain)->get();
    }

    /**
     * @param \Illuminate\Support\Collection $tokens
     * @return void
     */
    public function store(\Illuminate\Support\Collection $tokens): void
    {
        $tokens->each(function ($token) {
            $retrievableFields = collect($token)->only(['token_id', 'chain'])->all();
            $storableFields = collect($token)->except(['token_id', 'chain'])
                ->merge([
                    'row_uuid' => Util::uuid()
                ])->all();
            $this->model->firstOrCreate(
                $retrievableFields,
                $storableFields
            );
        });
    }
}
