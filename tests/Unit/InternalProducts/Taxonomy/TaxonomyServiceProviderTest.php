<?php

namespace OWC\PDC\Internal\Tests\Taxonomy;

use Mockery as m;
use OWC\PDC\Base\Foundation\Plugin;
use OWC\PDC\Base\Foundation\Loader;
use OWC\PDC\Internal\Taxonomy\TaxonomyServiceProvider;
use OWC\PDC\Internal\Tests\Unit\TestCase;

class TaxonomyServiceProviderTest extends TestCase
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
    public function it_registers_hooks_correctly()
    {
        $loader = m::mock(Loader::class);

        $plugin = m::mock(Plugin::class);
        $plugin->loader = $loader;

        $provider = new TaxonomyServiceProvider($plugin);

        $loader->shouldReceive('addAction')
            ->withArgs([
                'init', $provider, 'createTerms'
            ])
            ->once();

        $provider->register();

        $this->assertTrue(true);
    }

}
