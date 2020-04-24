<?php
namespace Commissions;

use PHPUnit\Framework\TestCase;
use Commissions\{BinProvider, NotFoundException, MalformatException};

class BinProviderTest extends TestCase
{
    private $binProviderBasePath  = __DIR__ . '/../../data/bins/';
    private $binProvider;

    public function __construct()
    {
        parent::__construct();
        $this->binProvider = new BinProvider($this->binProviderBasePath);
    }

    public function testResolve()
    {
        $this->assertEquals('DK', $this->binProvider->resolve(45717360)->country->alpha2);
        $this->assertEquals('GB', $this->binProvider->resolve(4745030)->country->alpha2);
    }

    public function testBinNotFoundException()
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("Bin not found. Path: {$this->binProviderBasePath}");
        $this->binProvider->resolve(100);
    }

    public function testBinMalformatException()
    {
        $this->expectException(MalformatException::class);
        $this->expectExceptionMessage('Malformat bin');
        $this->binProvider->resolve(10000000);
    }
}