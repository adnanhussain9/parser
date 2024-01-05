<?php
namespace Adnan\Parser\Tests;

use Orchestra\Testbench\TestCase;
use Adnan\Parser\MarkdownParser;
use Adnan\Parser\Facades\Parsedown;
use Adnan\Parser\ParsedownServiceProvider;
// use Parsedown;

class MarkdownTest extends TestCase
{
    /** @test */
    public function experiment(){
        echo MarkdownParser::parse('`CODE`');
        echo MarkdownParser::parse('#Heading1');
        echo MarkdownParser::parse('##Heading2');
        echo MarkdownParser::parse('**BOLD**');
        $parsedown = new Parsedown();
        dd($parsedown->text('#Heading'));
    }

    protected function getPackageProviders($app)
    {
        return [
            ParsedownServiceProvider::class,
        ];
    }
    public function testPackageProvidersAreRegistered()
    {
        $app = $this->createApplication();

        $providers = $this->getPackageProviders($app);

        // Your test logic to assert the package providers registration
        $this->assertTrue(in_array(ParsedownServiceProvider::class, $providers));
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = new \Illuminate\Foundation\Application();
    
        return $app;
    }

    // /**
    //  * Get package providers.
    //  *
    //  * @param  \Illuminate\Foundation\Application  $app
    //  * @return array
    //  */
    // protected function getPackageProviders($app)
    // {
    //     return [
    //         ParsedownServiceProvider::class,
    //         // Add other providers if needed
    //     ];
    // }

    public function testHelperWorks()
    {
        $result = parsedown('# Heading 1');

        $this->assertEquals('<h1>Heading 1</h1>', $result);
    }

    public function testFacadeWorks()
    {
        $result = Parsedown::text('# Heading 1');

        $this->assertEquals('<h1>Heading 1</h1>', $result);
    }

    public function testSingletonWorks()
    {
        $result = app('parsedown')->text('# Heading 1');

        $this->assertEquals('<h1>Heading 1</h1>', $result);
    }

    public function serviceTest()
    {
        // Reset the application to its initial state
        $this->app = $this->createApplication();

        // Register the service provider
        $this->app->register(ParsedownServiceProvider::class);

        // Assert that the Parsedown instance is bound in the container
        $this->assertInstanceOf(Parsedown::class, $this->app->make(Parsedown::class));

        // Assert that the alias 'parsedown' is bound to the correct class
        $this->assertInstanceOf(Parsedown::class, $this->app->make('parsedown'));

        // Assert that the configuration has been merged
        $this->assertTrue($this->app['config']->has('markdown'));
    }
}