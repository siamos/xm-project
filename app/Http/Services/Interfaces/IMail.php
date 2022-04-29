<?php
declare(strict_types=1);


namespace App\Http\Services\Interfaces;


use App\Http\Dto\GetDto;

interface IMail
{
    public function dispatchEmail(?array $company, GetDto $dto): bool;
}
