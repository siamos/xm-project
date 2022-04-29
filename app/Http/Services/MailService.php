<?php
declare(strict_types=1);


namespace App\Http\Services;


use App\Http\Dto\GetDto;
use App\Http\Dto\MailDto;
use App\Http\Services\Interfaces\IMail;
use App\Jobs\SendEmail;

class MailService implements IMail
{

    public function dispatchEmail(?array $company, GetDto $dto): bool
    {
        if (!empty($company)) {
            $mailDto = new MailDto(
                $dto->getEmail(),
                $company['Company Name'],
                $dto->getStartDateStrTime(),
                $dto->getEndDateStrTime()
            );

            SendEmail::dispatch($mailDto);

            return true;
        }

        return false;
    }

}
