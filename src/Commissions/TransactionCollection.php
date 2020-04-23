<?php

namespace Commissions;

use ArrayIterator;
use \Commissions\Transaction;

class TransactionCollection extends ArrayIterator
{
    public function __construct(Transaction ...$transactions)
    {
        parent::__construct($transactions);
    }

    public function current() : Transaction
    {
        return parent::current();
    }

    public function offsetGet($offset) : Transaction
    {
        return parent::offsetGet($offset);
    }
}