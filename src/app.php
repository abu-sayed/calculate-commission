<?php
namespace commission;

use commission\Commission;
use commission\BinProvider;
use commission\RatesProvider;
use commission\Eu;

require_once __DIR__ . '/../vendor/autoload.php';

$commissionsInputPath = $argv[1];
$binProviderBasePath  = 'https://lookup.binlist.net/';
$ratesProviderPath    = 'https://api.exchangeratesapi.io/latest';
$binProvider          = new BinProvider($binProviderBasePath);
$ratesProvider        = new RatesProvider($ratesProviderPath);
$commissionInstance   = new Commission($binProvider, $ratesProvider, new Eu());
$commissions          = $commissionInstance
  ->setTransactionsPath($commissionsInputPath)
  ->calculateCommissions()
  ;
$commissionInstance->printCommissions($commissions);
