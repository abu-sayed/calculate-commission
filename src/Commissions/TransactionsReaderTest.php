<?php
namespace Commissions;

use PHPUnit\Framework\TestCase;
use Commissions\{TransactionsReader, NotFoundException, MalformatException};

class TransactionsReaderTest extends TestCase
{
    private $transactionsReader;

    public function __construct()
    {
        parent::__construct();
        $this->transactionsReader = new TransactionsReader();
    }

    public function testRead()
    {
        $this->assertEquals(5, count($this->transactionsReader->read(__DIR__ . '/../../data/input.txt')));
    }

    public function testTransactionsNotFoundException()
    {
        $this->expectException(NotFoundException::class);
        $transactionsPath = __DIR__ . '/../../data/no-input.txt';
        $this->expectExceptionMessage("Transactions file path does not exist. Path: {$transactionsPath}");
        $this->transactionsReader->read($transactionsPath);
    }

    public function testTransactionsMalformatException()
    {
        $this->expectException(MalformatException::class);
        $transactionsPath = __DIR__ . '/../../data/input-malformat.txt';
        $this->expectExceptionMessage("Malformat transactions");
        $this->transactionsReader->read($transactionsPath);
    }
}