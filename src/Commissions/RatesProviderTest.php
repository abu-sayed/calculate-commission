<?php
namespace Commissions;

use PHPUnit\Framework\TestCase;
use Commissions\{RatesProvider, NotFoundException, MalformatException};

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

    public function testRatesNotFoundException()
    {
        $this->expectException(NotFoundException::class);
        $noRatesPath = __DIR__ . '/../../data/no-rates.json';
        $this->expectExceptionMessage("Rates not found. Path: {$noRatesPath}");
        $ratesProvider = new RatesProvider($noRatesPath);
        $ratesProvider->resolve('USD');
    }

    public function testRatesMalformatException()
    {
        $this->expectException(MalformatException::class);
        $this->expectExceptionMessage('Malformat rates');
        $ratesProvider = new RatesProvider(__DIR__ . '/../../data/rates-malformat.json');
        $ratesProvider->resolve('USD');
    }
}