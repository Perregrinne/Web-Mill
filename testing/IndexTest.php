<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    //Temporary test case, just to know that PHPUnit was set up properly:
    public function testFaviconExists()
    {
        $this->assert(file_exists($_SERVER['DOCUMENT_ROOT'] . 'favicon.ico'));
    }
}