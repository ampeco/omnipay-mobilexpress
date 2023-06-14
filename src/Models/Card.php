<?php

namespace Ampeco\OmnipayMobilExpress\Models;

class Card
{
    public string $cardType;
    public string $token;
    public string $number;
    public string $lastFour;
    public ?string $month;
    public ?string $year;
    public bool $isExpired;

    public function __construct(array $data)
    {
        $this->cardType = $data['cardType'];
        $this->token = $data['cardToken'];
        $this->number = $data['maskedCardNumber'];
        $this->month = $data['lastMonth'] ?? null;
        $this->year = $data['lastYear'] ?? null;
        $this->isExpired = $data['isExpired'] ?? false;

        $this->lastFour = substr($this->number, -4);
    }
}
