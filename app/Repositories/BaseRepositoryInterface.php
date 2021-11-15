<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function all(): \Illuminate\Database\Eloquent\Collection;
    public function count(): int;
    public function paginated(int $count): \Illuminate\Pagination\LengthAwarePaginator;
    public function create(array $attributes): \Illuminate\Database\Eloquent\Model;
    public function destroy(int $id);
    public function find($id): ?\Illuminate\Database\Eloquent\Model;
    public function update(\Illuminate\Database\Eloquent\Model $model, array $attributes): \Illuminate\Database\Eloquent\Model;
}
