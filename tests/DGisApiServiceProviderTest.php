<?php

namespace DGis\Tests\Silex\Api\Provider;

use DGis\Silex\Api\Provider\DGisApiServiceProvider;
use Silex\Application;

class DGisApiServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    protected $app;

    protected function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new DGisApiServiceProvider(), array(
            'dgis.api.options' => array(
                'key' => 'test',
            ),
        ));

        $this->app = $app;
    }

    public function testRegionClient()
    {
        $this->assertInstanceOf('\DGApiClient\Region', $this->app['dgis.api.region']);
    }

    public function testCatalogClient()
    {
        $this->assertInstanceOf('\DGApiClient\Catalog', $this->app['dgis.api.catalog']);
    }

    public function testTransportClient()
    {
        $this->assertInstanceOf('\DGApiClient\Transport', $this->app['dgis.api.transport']);
    }

    public function testGeoClient()
    {
        $this->assertInstanceOf('\DGApiClient\Geo', $this->app['dgis.api.geo']);
    }
}
