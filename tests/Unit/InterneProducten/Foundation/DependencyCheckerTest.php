<?php

namespace OWC\PDC\InterneProducten\Foundation;

use Mockery as m;
use OWC\PDC\InterneProducten\Tests\Unit\TestCase;

class DependencyCheckerTest extends TestCase
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
    public function it_fails_when_plugin_is_inactive()
    {
        $dependencies = [
            [
                'label' => 'Dependency #1',
                'file'  => 'test-plugin/test-plugin.php'
            ]
        ];

        $checker = new DependencyChecker($this->getPlugin(), $dependencies);

        \WP_Mock::userFunction('is_plugin_active')
            ->withArgs([ 'test-plugin/test-plugin.php' ])
            ->once()
            ->andReturn(false);

        $this->assertTrue($checker->failed());
    }

    /** @test */
    public function it_succeeds_when_no_dependencies_are_set()
    {
        $checker = new DependencyChecker($this->getPlugin(), []);

        \WP_Mock::userFunction('is_plugin_active')
            ->never();

        $this->assertFalse($checker->failed());
    }

    /**
     * @dataProvider wrongVersions
     * @test
     */
    public function it_fails_when_plugin_is_active_but_versions_mismatch($version)
    {
        $dependencies = [
            [
                'label'   => 'Dependency #1',
                'file'    => 'pluginstub.php', // tests/Unit/pluginstub.php
                'version' => $version // Version in pluginstub.php is 1.1.5
            ]
        ];

        $checker = new DependencyChecker($this->getPlugin(), $dependencies);

        \WP_Mock::userFunction('is_plugin_active')
            ->withArgs([ 'pluginstub.php' ])
            ->once()
            ->andReturn(true);

        $this->assertTrue($checker->failed());
    }

    /**
     * @dataProvider correctVersions
     * @test
     */
    public function it_succeeds_when_plugin_is_active_and_versions_match($version)
    {
        $dependencies = [
            [
                'label'   => 'Dependency #1',
                'file'    => 'pluginstub.php', // tests/Unit/pluginstub.php
                'version' => $version // Version in pluginstub.php is 1.1.5
            ]
        ];

        $checker = new DependencyChecker($this->getPlugin(), $dependencies);

        \WP_Mock::userFunction('is_plugin_active')
            ->withArgs([ 'pluginstub.php' ])
            ->once()
            ->andReturn(true);

        $this->assertFalse($checker->failed());
    }


    /**
     * Provides old version numbers.
     * Version in pluginstub.php is 1.1.5
     *
     * @return array
     */
    public function wrongVersions()
    {
        return [
            [ '1.1.8' ],
            [ '2.0' ],
            [ '3' ]
        ];
    }

    public function correctVersions()
    {
        return [
            ['1.1.2'],
            ['1.0'],
            ['1']
        ];
    }


    private function getPlugin()
    {
        $plugin = m::mock(Plugin::class);
        $plugin->shouldReceive('getName')
            ->andReturn('testplugin');

        return $plugin;
    }
}
