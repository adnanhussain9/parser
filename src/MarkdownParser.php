<?php

namespace Adnan\Parser;

use Parsedown;

class MarkdownParser{
    protected $parser;

    public function __construct()
    {
        $this->parser = new Parsedown();
    }

    public function parse($markdown)
    {
        return $this->parser->text($markdown);
    }
}