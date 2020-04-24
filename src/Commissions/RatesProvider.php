<?php
namespace Commissions;

use Commissions\{ProviderInterface, NotFoundException, MalformatException};

class RatesProvider implements ProviderInterface
{
	private $ratesPath;
	private $rates;

	public function __construct(string $ratesPath)
	{
		$this->ratesPath = $ratesPath;
		return $this;
	}

	/**
     * @throws NotFoundException if bin path does not exist 
     * @throws MalformatException if bin is not in JSON format 
     */
	public function resolve($currency): float
	{
		if ($this->rates) {
			return (float) $this->rates[$currency];
		}

		$ratesJson =  @file_get_contents($this->ratesPath);
        if ($ratesJson === false) {
            throw new NotFoundException("Rates not found. Path: {$this->ratesPath}");
		}
		
		try {
			$this->rates = json_decode($ratesJson, true, 512, JSON_THROW_ON_ERROR)['rates'];
		} catch (\Exception $exception) {
			throw new MalformatException("Malformat rates");
		}

		return (float) $this->rates[$currency];
	}
}
