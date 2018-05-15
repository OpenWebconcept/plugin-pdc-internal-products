<?php

namespace OWC\PDC\Internal\Tests\RestAPI;

use Mockery as m;
use OWC\PDC\Internal\RestAPI\FilterResults;
use OWC\PDC\Internal\Tests\Unit\TestCase;

class FilterResultsTest extends TestCase
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
    public function it_defaults_to_external()
    {
        $filter = new FilterResults;
        $request = m::mock(\WP_REST_Request::class);
        $request->shouldReceive('get_query_params')
            ->once()
            ->andReturn([
                'type' => 'anything'
            ]);

        $filtered = $filter->filter([
            'posts_per_page' => 3
        ], $request);

        $this->assertEquals([
            [
                'taxonomy' => 'pdc-type',
                'field'    => 'slug',
                'terms'    => 'external'
            ]
        ], $filtered['tax_query']);
    }

    /** @test */
    public function it_goes_to_internal_when_specified()
    {
        $filter = new FilterResults;
        $request = m::mock(\WP_REST_Request::class);
        $request->shouldReceive('get_query_params')
            ->once()
            ->andReturn([
                'type' => 'internal'
            ]);

        $filtered = $filter->filter([
            'posts_per_page' => 3
        ], $request);

        $this->assertEquals([
            [
                'taxonomy' => 'pdc-type',
                'field'    => 'slug',
                'terms'    => 'internal'
            ]
        ], $filtered['tax_query']);
    }

}
