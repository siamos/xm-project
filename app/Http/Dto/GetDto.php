<?php
declare(strict_types=1);


namespace App\Http\Dto;


class GetDto
{

    private string $symbol;
    private string $email;
    private string $startDate;
    private string $endDate;

    public function __construct(string $symbol, string $email, string $startDate, string $endDate)
    {
        $this->symbol    = $symbol;
        $this->email     = $email;
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }


    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getStartDateStrTime(): int
    {
        return strtotime($this->startDate);
    }


    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }


    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getEndDateStrTime(): int
    {
        return strtotime('+1 day', strtotime($this->endDate));
    }

    public function setEndDate(string $endDate): void
    {
        $this->endDate = $endDate;
    }


}
