<?php
declare(strict_types=1);


namespace App\Http\Repositories;


namespace App\Http\Repositories;
use App\Http\Repositories\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }


    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }


    public function insert(array $attributes): bool
    {
        return $this->model->insert($attributes);
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    public function delete(int $id): int
    {
        return $this->model::destroy($id);
    }

    public function getAll($columns = ['*']): Collection
    {
        return $this->model::all($columns);
    }
}

