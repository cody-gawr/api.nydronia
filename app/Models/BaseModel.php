<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes,
    Factories\HasFactory
};

use Util;

class BaseModel extends Model {
    use SoftDeletes;
    use HasFactory;

    const CREATED_AT = 'stamp_created_at';
    const STAMP_CREATED = 'stamp_created';
    const IDX_STAMP_CREATED = 'idx_stamp-created';

    const UPDATED_AT = 'stamp_updated_at';
    const STAMP_UPDATED = 'stamp_updated';
    const IDX_STAMP_UPDATED = 'idx_stamp-updated';

    const DELETED_AT = 'stamp_deleted_at';
    const STAMP_DELETED = 'stamp_deleted';
    const IDX_STAMP_DELETED = 'idx_stamp-deleted';

    protected $uuid = '';

    protected $hidden = [
        BaseModel::CREATED_AT,
        BaseModel::UPDATED_AT,
        BaseModel::DELETED_AT,
        BaseModel::STAMP_DELETED
    ];

    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->{static::STAMP_CREATED} = time();
            $model->{static::STAMP_UPDATED} = time();
        });

        static::updating(function ($model) {
            $model->{static::STAMP_UPDATED} = time();
        });

        static::deleting(function ($model) {
            $model->{static::STAMP_DELETED} = time();
            $model->save();
        });
    }

    public function uuid() {
        return $this->uuid;
    }
}
