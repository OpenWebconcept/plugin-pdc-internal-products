<?php

namespace OWC\PDC\InternalProducts\RestAPI;

use Mockery as m;
use OWC\PDC\Base\Foundation\Config;
use OWC\PDC\Base\Foundation\Loader;
use OWC\PDC\Base\Foundation\Plugin;
use OWC\PDC\InternalProducts\RestAPI\FilterDefaultItems;
use OWC\PDC\InternalProducts\RestAPI\RestAPIServiceProvider;
use OWC\PDC\InternalProducts\Tests\Unit\TestCase;
use WP_Mock;

class RestAPIServiceProviderTest extends TestCase
{

    public function setUp()
    {
        WP_Mock::setUp();
    }

    public function tearDown()
    {
        WP_Mock::tearDown();
    }

    /** @test */
    public function check_registration_of_restapi()
    {
        $config = m::mock(Config::class);
        $plugin = m::mock(Plugin::class);

        $plugin->config = $config;
        $plugin->loader = m::mock(Loader::class);

        $service = new RestAPIServiceProvider($plugin);

        $plugin->loader->shouldReceive('addAction')->withArgs([
            'rest_api_init',
            $service,
            'registerRoutes',
        ])->once();

        $filterDefaultItems = m::mock(FilterDefaultItems::class);

        $plugin->loader->shouldReceive('addFilter')
            ->withArgs(function ($hook, $instance, $method, $priority, $arguments) {

                $this->assertInstanceOf(FilterDefaultItems::class, $instance);

                $this->assertEquals('owc/pdc/rest-api/items/query', $hook);

                return true;
            })
            ->once();

        $service->register();
    }
}
