<?php
namespace Commission;

use PHPUnit\Framework\TestCase;
use Commissions\{BinProvider, RatesProvider, Eu, Commission, TransactionsReader};

class CommissionTest extends TestCase
{
    public function testCalculateCommissions()
    {
        $commissionsInputPath = __DIR__ . '/../../data/input.txt';
        $binProviderBasePath  = __DIR__ . '/../../data/bins/';
        $ratesProviderPath    = __DIR__ . '/../../data/rates.json';
        $binProvider          = new BinProvider($binProviderBasePath);
        $ratesProvider        = new RatesProvider($ratesProviderPath);
        $commissionInstance   = new Commission($binProvider, $ratesProvider, new Eu());
        $transactionsReader   = new TransactionsReader();
        $commissions          = $commissionInstance
        ->calculateCommissions($transactionsReader->read($commissionsInputPath))
        ;
        $this->assertEquals(5, count($commissions));

        $this->assertEquals(1, $commissions[0]);
        $this->assertEquals(0.46, $commissions[1]);
        $this->assertEquals(1.71, $commissions[2]);
        $this->assertEquals(2.39, $commissions[3]);
        $this->assertEquals(45.78, $commissions[4]);
    }
}