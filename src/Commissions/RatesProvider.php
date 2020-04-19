<?php
namespace Commissions;

use Commissions\ProviderInterface;

class RatesProvider implements ProviderInterface
{
	private $ratesPath;
	private $rates;

	public function __construct(string $ratesPath)
	{
		$this->ratesPath = $ratesPath;
		return $this;
	}

	public function resolve($currency)
	{
		if (!$this->rates) {
			$this->rates = @json_decode(file_get_contents($this->ratesPath), true)['rates'];
		}
		return $this->rates[$currency];
	}
}
