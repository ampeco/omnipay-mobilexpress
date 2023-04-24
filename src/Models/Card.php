<?php

namespace Ampeco\OmnipayMobilExpress\Models;

class Card
{
    public string $cardType;
    public string $token;
    public string $number;
    public string $lastFour;

    public function __construct(array $data)
    {
        $this->cardType = $data['cardType'];
        $this->token = $data['cardToken'];
        $this->number = $data['maskedCardNumber'];

        $this->lastFour = substr($this->number, -4);
    }
}
