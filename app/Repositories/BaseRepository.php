<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Traits\Sortable;
use Util;

abstract class BaseRepository implements BaseRepositoryInterface
{
    use Sortable;

    public $sortBy = BaseModel::STAMP_CREATED;
    public $sortOrder = "asc";
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    /**
     * BaseRepository constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(\Illuminate\Database\Eloquent\Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return ($this->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->get());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->all()->count();
    }

    /**
     * @param int $count
     * @return
     */
    public function paginated(int $count): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($count);
    }

    /**
     * @param array $attributes
     * @return BaseModel
     */
    public function create(array $attributes): BaseModel
    {
        $model = $this->model->newInstance();
        if (!isset($attributes[$model->uuid()]))
            $attributes[$model->uuid()] = Util::uuid();
        $model->create($attributes);

        return $model;
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        return ($this->find($id)->delete());
    }

    /**
     * @param string|int $id
     * @return BaseModel|null
     */
    public function find($id): ?BaseModel
    {
        if (is_int($id)) {
            return ($this->model->find($id));
        } else if (is_string($id)) {
            return ($this->model->where($this->model->uuid(), $id)->first());
        }
    }

    /**
     * @param Model $model
     * @param array $attributes
     *
     * @return BaseModel
     */
    public function update(\Illuminate\Database\Eloquent\Model $model, array $attributes): BaseModel
    {
        $model->update($attributes);

        return $model;
    }
}
