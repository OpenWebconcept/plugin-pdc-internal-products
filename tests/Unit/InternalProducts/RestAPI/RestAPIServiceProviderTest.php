<?php

namespace OWC\PDC\Internal\Tests\RestAPI;

use Mockery as m;
use OWC\PDC\Base\Foundation\Plugin;
use OWC\PDC\Base\Foundation\Loader;
use OWC\PDC\Internal\RestAPI\RestAPIServiceProvider;
use OWC\PDC\Internal\Tests\Unit\TestCase;
use OWC\PDC\Internal\RestAPI\FilterResults;

class RestAPIServiceProviderTest extends TestCase
{

    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    /** @test */
    public function it_register_restapi_service_correctly()
    {
        $loader = m::mock(Loader::class);

        $plugin = m::mock(Plugin::class);
        $plugin->loader = $loader;

        $loader->shouldReceive('addAction')
            ->withArgs(function ($hook, $component, $method, $priority, $arguments) {
                $this->assertEquals('rest_pdc-item_query', $hook);
                $this->assertInstanceOf(FilterResults::class, $component);
                $this->assertEquals('filter', $method);
                $this->assertEquals(10, $priority);
                $this->assertEquals(2, $arguments);

                return true;
            })
            ->once();

        $provider = new RestAPIServiceProvider($plugin);
        $provider->register();
    }

}
