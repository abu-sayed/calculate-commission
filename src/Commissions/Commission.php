<?php

namespace Commissions;

use Commissions\{TransactionCollection, ProviderInterface, Eu};

class Commission
{
	private $binProvider;
	private $ratesProvider;
	private $eU;
	private const EU_COMMISSION = 0.01;
	private const NON_EU_COMMISSION = 0.02;

	public function __construct(ProviderInterface $binProvider, ProviderInterface $ratesProvider, Eu $eU)
	{
		$this->binProvider   = $binProvider;
		$this->ratesProvider = $ratesProvider;
		$this->eU            = $eU;
	}

	private function isBinEuCountry(int $binId): bool
	{
		$binResult = $this->binProvider->resolve($binId);
		return $this->eU->isEuCountry($binResult->country->alpha2);
	}

	public function calculateCommissions(TransactionCollection $transactions): array
	{
		$commissions = [];
		foreach($transactions as $transaction) {
			$rate              = $this->ratesProvider->resolve($transaction->getCurrency());
			$amountFixed       = !empty($rate) ? $transaction->getAmount() / $rate : $transaction->getAmount();
			$commission        = $amountFixed * ($this->isBinEuCountry($transaction->getBin()) === true ? Commission::EU_COMMISSION : Commission::NON_EU_COMMISSION);
			$flooredCommission = floor($commission * 100)/100;
			$commissions[]     = $commission > $flooredCommission ? $flooredCommission + 0.01 : $flooredCommission;
		}

		return $commissions;
	}

	public function printCommissions(array $commissions)
	{
		foreach ($commissions as $commission) {
			print "{$commission}\n";
		}
	}
}
