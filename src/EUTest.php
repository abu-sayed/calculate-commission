<?
namespace commission;

use PHPUnit\Framework\TestCase;
use commission\Eu;

class EuTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIsEuCountry($countryShortCode, $expected)
    {
        $eU = new Eu();
        $this->assertEquals($expected, $eU->isEuCountry($countryShortCode));
    }

    public function additionProvider()
    {
        return [
            ['BE', true],
            ['US', false],
        ];
    }
}