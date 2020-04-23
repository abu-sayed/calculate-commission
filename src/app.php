<?php
use Commissions\{Commission, TransactionsReader, BinProvider, RatesProvider, Eu, NotFoundException, MalformatException};

require_once __DIR__ . '/../vendor/autoload.php';

$binProvider          = new BinProvider('https://lookup.binlist.net/');
$ratesProvider        = new RatesProvider('https://api.exchangeratesapi.io/latest');
$commissionInstance   = new Commission($binProvider, $ratesProvider, new Eu());
$transactionsReader   = new TransactionsReader();

try {
  $commissions = $commissionInstance->calculateCommissions($transactionsReader->read($argv[1]));
  $commissionInstance->printCommissions($commissions);
} catch (NotFoundException $notFoundException) {
  echo $notFoundException->getMessage();
} catch (MalformatException $malformatException) {
  echo $malformatException->getMessage();
} catch (\Exception $exception) {
  echo $exception->getMessage();
}

