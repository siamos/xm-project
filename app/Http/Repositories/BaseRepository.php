<?php
declare(strict_types=1);


namespace App\Http\Repositories;


namespace App\Http\Repositories;
use App\Http\Repositories\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function findBySlug(string $slug): ?Model
    {
        return $this->model::where('slug', $slug)->firstOrFail();
    }

    public function search(string $query): ?Collection
    {
        return $this->model->search($query)->take(10)->get();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function updateOrCreate(array $valuesExit, array $attributes): Model
    {
        return $this->model->updateOrCreate($valuesExit, $attributes);
    }

    public function insertGetId(array $attributes): string|int
    {
        return $this->model->insertGetId($attributes);
    }

    public function insert(array $attributes): bool
    {
        return $this->model->insert($attributes);
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    public function updateUuid(string $id, array $attributes): bool
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

    public function getAllActive(): Collection
    {
        return $this->model::where('active', 1)->get();
    }

    public function getAllStatusActive(array $columns = ['*']): Collection
    {
        return $this->model::select($columns)->where('status', 1)->get();
    }

    public function getPagination(int $perPage = 30, int $status = 1, array $columns = ['*'], string $pageName = ''): LengthAwarePaginator
    {
        return $this->model::where('status', $status)->paginate($perPage, $columns , $pageName);
    }

    public function getPaginationWithoutStatus(int $perPage = 30, array $columns = ['*'], string $pageName = ''): LengthAwarePaginator
    {
        return $this->model::paginate($perPage, $columns , $pageName);
    }

    public function getItemsByArray(array $ids): Collection
    {
        return $this->model::where('active', 1)->whereIn('id', $ids)->get();
    }
}

