<?php
namespace Commissions;

use Commissions\ProviderInterface;

class BinProvider implements ProviderInterface
{
	private $binPath;

	public function __construct(string $binPath)
	{
		$this->binPath = $binPath;
		return $this;
	}

	public function resolve($binId)
	{
		$binJson = file_get_contents($this->binPath.$binId);
		if (!$binJson) {
			die('error!');
		}
		$bin = json_decode($binJson);
		return $bin->country->alpha2;
	}
}
