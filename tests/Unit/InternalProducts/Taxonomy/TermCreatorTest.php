<?php

namespace OWC\PDC\Internal\Tests\Taxonomy;

use Mockery as m;
use OWC\PDC\Internal\Taxonomy\TermCreator;
use OWC\PDC\Internal\Tests\Unit\TestCase;

class TermCreatorTest extends TestCase
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
    public function it_creates_term_if_not_exists()
    {
        $creator = new TermCreator('test-tax');

        \WP_Mock::userFunction('term_exists')
            ->withArgs([ 'testterm', 'test-tax' ])
            ->once()
            ->andReturn(null);

        \WP_Mock::userFunction('wp_insert_term')
            ->withArgs(['testterm', 'test-tax'])
            ->once();

        $creator->createIfNotExists('testterm');

        $this->assertTrue(true);
    }

    /** @test */
    public function it_does_not_create_if_exists()
    {
        $creator = new TermCreator('test-tax');

        \WP_Mock::userFunction('term_exists')
            ->withArgs([ 'testterm', 'test-tax' ])
            ->once()
            ->andReturn(true);

        \WP_Mock::userFunction('wp_insert_term')
            ->withArgs(['testterm', 'test-tax'])
            ->never();

        $creator->createIfNotExists('testterm');

        $this->assertTrue(true);
    }

}
