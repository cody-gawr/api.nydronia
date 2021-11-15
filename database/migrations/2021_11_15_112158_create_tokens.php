<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\BaseModel;

class CreateTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('row_id');
            $table->uuid('row_uuid')->unique('uidx_row-uuid');
            $table->string('token_id', 64);
            $table->string('name', 64)->nullable();
            $table->string('symbol', 64)->nullable();
            $table->string('contract_address', 128);
            $table->string('chain', 128);

            $table->unsignedBigInteger(BaseModel::STAMP_CREATED)->index(BaseModel::IDX_STAMP_CREATED)->nullable();
            $table->timestamp(BaseModel::CREATED_AT)->nullable();
            $table->unsignedBigInteger(BaseModel::STAMP_UPDATED)->index(BaseModel::IDX_STAMP_UPDATED)->nullable();
            $table->timestamp(BaseModel::UPDATED_AT)->nullable();
            $table->unsignedBigInteger(BaseModel::STAMP_DELETED)->index(BaseModel::IDX_STAMP_DELETED)->nullable();
            $table->timestamp(BaseModel::DELETED_AT)->nullable();

            $table->unique(['token_id', 'chain'], 'uidx_token-id_chain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
