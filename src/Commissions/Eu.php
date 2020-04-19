<?php

namespace Commissions;

class Eu
{
	private $eUCountries = [
		'AT',
		'BE',
		'BG',
		'CY',
		'CZ',
		'DE',
		'DK',
		'EE',
		'ES',
		'FI',
		'FR',
		'GR',
		'HR',
		'HU',
		'IE',
		'IT',
		'LT',
		'LU',
		'LV',
		'MT',
		'NL',
		'PO',
		'PT',
		'RO',
		'SE',
		'SI',
		'SK',
	];

	public function isEuCountry($country): bool
	{
		return in_array($country, $this->eUCountries, true);
	}
}
