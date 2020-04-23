<?php

namespace Commissions;

class Transaction
{
    private $bin;
    private $amount;
    private $currency;

    public function __construct(int $bin = 0, float $amount = 0, string $currency = '')
    {
        $this->bin = $bin;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function setBin(int $bin): Transaction
    {
        $this->bin = $bin;
        return $this;
    }

    public function setAmount(int $amount): Transaction
    {
        $this->amount = $amount;
        return $this;
    }

    public function setCurrency(int $currency): Transaction
    {
        $this->currency = $currency;
        return $this;
    }

    public function getBin(): int
    {
        return $this->bin;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}