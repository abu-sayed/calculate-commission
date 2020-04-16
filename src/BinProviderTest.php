<?php
namespace commission;

use PHPUnit\Framework\TestCase;
use commission\BinProvider;

class BinProviderTest extends TestCase
{
    public function testResolve()
    {
        $binProviderBasePath  = __DIR__ . '/../data/bins/';
        $binProvider          = new BinProvider($binProviderBasePath);
        $this->assertEquals('DK', $binProvider->resolve(45717360));
        $this->assertEquals('GB', $binProvider->resolve(4745030));
    }
}