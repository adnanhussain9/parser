<?php
namespace Adnan\Parser\Tests;

use Orchestra\Testbench\TestCase;
use Adnan\Parser\MarkdownParser;
use Adnan\Parser\ParsedownServiceProvider;
use Parsedown;

class MarkdownTest extends TestCase
{
    /** @test */
    public function experiment(){
        echo MarkdownParser::parse('`CODE`');
        echo MarkdownParser::parse('##Heading1');
        echo MarkdownParser::parse('##Heading2');
        echo MarkdownParser::parse('**BOLD**');
        $parsedown = new Parsedown();
        dd($parsedown->text('#Heading'));
    }

    public function serviceCheck(){
        // 
    }
    protected function getPackageProviders($app)
    {
        return [
            ParsedownServiceProvider::class,
        ];
    }
}