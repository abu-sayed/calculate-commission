<?php
namespace commission;

use PHPUnit\Framework\TestCase;
use commission\BinProvider;
use commission\RatesProvider;
use commission\Eu;
use commission\Commission;

class CommissionTest extends TestCase
{
    public function testCalculateCommissions()
    {
        $commissionsInputPath = __DIR__ . '/../data/input.txt';
        $binProviderBasePath  = __DIR__ . '/../data/bins/';
        $ratesProviderPath    = __DIR__ . '/../data/rates.json';
        $binProvider          = new BinProvider($binProviderBasePath);
        $ratesProvider        = new RatesProvider($ratesProviderPath);
        $commissionInstance   = new Commission($binProvider, $ratesProvider, new Eu());
        $commissions          = $commissionInstance
        ->setTransactionsPath($commissionsInputPath)
        ->calculateCommissions()
        ;
        $this->assertEquals(5, count($commissions));

        $this->assertEquals(1, $commissions[0]);
        $this->assertEquals(0.46, $commissions[1]);
        $this->assertEquals(1.71, $commissions[2]);
        $this->assertEquals(2.39, $commissions[3]);
        $this->assertEquals(45.78, $commissions[4]);
    }
}