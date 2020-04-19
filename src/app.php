<?php
use Commissions\{Commission, BinProvider, RatesProvider, Eu};

require_once __DIR__ . '/../vendor/autoload.php';

$binProvider          = new BinProvider('https://lookup.binlist.net/');
$ratesProvider        = new RatesProvider('https://api.exchangeratesapi.io/latest');
$commissionInstance   = new Commission($binProvider, $ratesProvider, new Eu());
$commissions          = $commissionInstance
  ->setTransactionsPath($argv[1])
  ->calculateCommissions()
  ;
$commissionInstance->printCommissions($commissions);
