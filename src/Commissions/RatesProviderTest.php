<?php
namespace Commissions;

use PHPUnit\Framework\TestCase;
use Commissions\RatesProvider;

class RatesProviderTest extends TestCase
{
    public function testResolve()
    {
        $ratesProviderPath    = __DIR__ . '/../../data/rates.json';
        $ratesProvider        = new RatesProvider($ratesProviderPath);
        $this->assertEquals(0, $ratesProvider->resolve('EUR'));
        $this->assertEquals(1.0903, $ratesProvider->resolve('USD'));
        $this->assertEquals(7.5093, $ratesProvider->resolve('TRY'));
    }
}