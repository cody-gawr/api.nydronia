<?php

namespace App\Models;

class Token extends BaseModel
{
    protected $table = 'tokens';

    protected $primaryKey = 'row_id';

    protected $uuid = 'row_uuid';

    protected $hidden = [
        'row_id',
        BaseModel::CREATED_AT, BaseModel::UPDATED_AT,
        BaseModel::DELETED_AT, BaseModel::STAMP_DELETED
    ];

    /**
     * Scope a query to only include tokens of a given chain.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $chain
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfChain($query, $chain)
    {
        return $query->where('chain', $chain);
    }
}
