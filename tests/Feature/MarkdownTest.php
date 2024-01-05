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

    protected function getPackageProviders($app)
    {
        return [
            ParsedownServiceProvider::class,
        ];
    }
}