<?php
declare(strict_types=1);


namespace App\Http\Dto;


class MailDto
{
    private string $subject;
    private int    $start;
    private int    $end;
    private string $email;

    public function __construct(string $email, string $subject, int $start, int $end)
    {
        $this->subject = $subject;
        $this->start   = $start;
        $this->end     = $end;
        $this->email   = $email;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail($email): void
    {
        $this->email = $email;
    }



    public function getSubject(): string
    {
        return $this->subject;
    }


    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }


    public function getStart(): int
    {
        return $this->start;
    }


    public function setStart($start): void
    {
        $this->start = $start;
    }


    public function getEnd(): int
    {
        return $this->end;
    }


    public function setEnd($end): void
    {
        $this->end = $end;
    }
}
