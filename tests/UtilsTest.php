<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Gekko\Helpers\Utils;

final class UtilsTest extends TestCase
{
    public function testUriToArrayReturnsArray(): void
    {
        $this->assertIsArray(Utils::uriToArray(""));
        $this->assertIsArray(Utils::uriToArray("test"));
        $this->assertIsArray(Utils::uriToArray("test/uri"));
        $this->assertIsArray(Utils::uriToArray("test/uri/2"));
    }

    public function testUriToArrayReturnsUriSegments(): void
    {
        $this->assertEquals(0, count(Utils::uriToArray("")));
        
        $one = Utils::uriToArray("test");
        $this->assertEquals(1, count($one));
        $this->assertEquals("test", $one[0]);

        $two = Utils::uriToArray("test/uri");
        $this->assertEquals(2, count($two));
        $this->assertEquals("test", $two[0]);
        $this->assertEquals("uri", $two[1]);

        $three = Utils::uriToArray("test/uri/2");
        $this->assertEquals(3, count($three));
        $this->assertEquals("test", $three[0]);
        $this->assertEquals("uri", $three[1]);
        $this->assertEquals("2", $three[2]);
    }

    public function testPathToArrayReturnsArray(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->assertIsArray(Utils::pathToArray(""));
        $this->assertIsArray(Utils::pathToArray("test"));
        $this->assertIsArray(Utils::pathToArray("test{$ds}uri"));
        $this->assertIsArray(Utils::pathToArray("test{$ds}uri{$ds}2"));
    }

    public function testPathToArrayReturnsPathSegments(): void
    {
        $this->assertEquals(0, count(Utils::pathToArray("")));
        
        $ds = DIRECTORY_SEPARATOR;

        $one = Utils::pathToArray("test");
        $this->assertEquals(1, count($one));
        $this->assertEquals("test", $one[0]);

        $two = Utils::pathToArray("test{$ds}uri");
        $this->assertEquals(2, count($two));
        $this->assertEquals("test", $two[0]);
        $this->assertEquals("uri", $two[1]);

        $three = Utils::pathToArray("test{$ds}uri{$ds}2");
        $this->assertEquals(3, count($three));
        $this->assertEquals("test", $three[0]);
        $this->assertEquals("uri", $three[1]);
        $this->assertEquals("2", $three[2]);
    }

    public function testPathsAreValid() : void
    {
        $ds = DIRECTORY_SEPARATOR;

        $this->assertEquals("", Utils::path());
        $this->assertEquals("", Utils::path(""));
        $this->assertEquals("test", Utils::path("test"));
        $this->assertEquals("test{$ds}path", Utils::path("test", "path"));
        $this->assertEquals("test{$ds}path", Utils::path("test", "", "path"));
        $this->assertEquals("test{$ds}path", Utils::path("test", "", "", "", "path"));
        $this->assertEquals("test{$ds}path{$ds}2", Utils::path("test", "path", "2"));
    }
}