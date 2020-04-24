<?php
namespace Commissions;

use Commissions\{ProviderInterface, NotFoundException, MalformatException};
use stdClass;

class BinProvider implements ProviderInterface
{
	private $binPath;

	public function __construct(string $binPath)
	{
		$this->binPath = $binPath;
		return $this;
	}

	/**
     * @throws NotFoundException if bin path does not exist 
     * @throws MalformatException if bin is not in JSON format 
     */
	public function resolve($binId): stdClass
	{
		$binJson =  @file_get_contents($this->binPath.$binId);
        if ($binJson === false) {
            throw new NotFoundException("Bin not found. Path: {$this->binPath}{$binId}");
        }
		
		try {
			return json_decode($binJson, false, 512, JSON_THROW_ON_ERROR);
		} catch (\Exception $exception) {
			throw new MalformatException("Malformat bin");
		}
	}
}
