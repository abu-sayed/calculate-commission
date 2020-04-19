<?php

namespace Commissions;

use Commissions\{ProviderInterface, Eu};

class Commission
{
	private $binProvider;
	private $ratesProvider;
	private $transactionsPath;
	private $eU;
	private const EU_COMMISSION = 0.01;
	private const NON_EU_COMMISSION = 0.02;

	public function __construct(ProviderInterface $binProvider, ProviderInterface $ratesProvider, Eu $eU)
	{
		$this->binProvider   = $binProvider;
		$this->ratesProvider = $ratesProvider;
		$this->eU            = $eU;
	}

	public function setTransactionsPath(string $transactionsPath)
	{
		$this->transactionsPath = $transactionsPath;
		return $this;
	}

	public function calculateCommissions(): array
	{
		$transactionsJson = explode("\n", file_get_contents($this->transactionsPath));

		$commissions = array_map(function ($transactionJson) {
			$transaction = @json_decode($transactionJson);
			$isEuCountry = $this->eU->isEuCountry($this->binProvider->resolve($transaction->bin));
			$rate        = $this->ratesProvider->resolve($transaction->currency);
			$amountFixed = $transaction->currency === 'EUR' || $rate === 0  ? $transaction->amount : 0;
			$amountFixed = $transaction->currency !== 'EUR' || $rate > 0 ? $transaction->amount / $rate : $amountFixed;
			$commission  = $amountFixed * ($isEuCountry === true ? Commission::EU_COMMISSION : Commission::NON_EU_COMMISSION);
			$flooredCommission = floor($commission * 100)/100;
			if ($commission > $flooredCommission) {
				return $flooredCommission + 0.01;
			}
			return $flooredCommission;
		}, $transactionsJson);

		return $commissions;
	}

	public function printCommissions(array $commissions)
	{
		foreach ($commissions as $commission) {
			print "{$commission}\n";
		}
	}
}
