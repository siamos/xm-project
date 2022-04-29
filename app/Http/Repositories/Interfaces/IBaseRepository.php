<?php
declare(strict_types=1);


namespace App\Http\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    public function find(int $id): ?Model;
    public function create(array $attributes): Model;
    public function insert(array $attributes): bool;
    public function update(int $id, array $attributes): bool;
    public function delete(int $id): int;
    public function getAll($columns = ['*']): Collection;
}
