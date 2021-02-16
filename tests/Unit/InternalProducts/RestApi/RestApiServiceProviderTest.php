<?php

namespace OWC\PDC\InternalProducts\RestAPI;

use Mockery;
use OWC\PDC\Base\Foundation\Loader;
use OWC\PDC\InternalProducts\RestAPI\FilterDefaultItems;
use OWC\PDC\InternalProducts\RestAPI\RestAPIServiceProvider;
use OWC\PDC\InternalProducts\Tests\Unit\TestCase;
use WP_Mock;

class RestAPIServiceProviderTest extends TestCase
{
    public function setUp(): void
    {
        WP_Mock::setUp();
    }

    public function tearDown(): void
    {
        WP_Mock::tearDown();
    }

    /** @test */
    public function check_registration_of_restapi()
    {
        $config = Mockery::mock('OWC\PDC\Base\Foundation\Config');
        $plugin = Mockery::mock('OWC\PDC\Base\Foundation\Plugin');

        $plugin->config = $config;
        $plugin->loader = Mockery::mock(Loader::class);

        WP_Mock::userFunction('wp_parse_args', [
            'return' => []
        ]);
        WP_Mock::userFunction('get_option');

        $service = new RestAPIServiceProvider($plugin);

        $plugin->loader->shouldReceive('addAction')->withArgs([
            'rest_api_init',
            $service,
            'registerRoutes',
        ])->once();

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
