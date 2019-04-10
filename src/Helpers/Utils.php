<?php
/*
 * (c) Leonardo Brugnara
 *
 * Full copyright and license information in LICENSE file.
 */

namespace Gekko\Helpers;

class Utils
{
    public static function uriToArray(string $uri) : array
    {
        return array_values(array_filter(explode("/", $uri), '\strlen'));
    }

    public static function pathToArray(string $path) : array
    {
        return array_values(array_filter(explode(DIRECTORY_SEPARATOR, $path), '\strlen'));
    }

    public static function path(string ...$parts) : string
    {
        return implode(DIRECTORY_SEPARATOR, array_filter($parts));
    }

    public static function hash($algorithm, $value, $salt = "")
    {
        switch ($algorithm) {
            case 'sha1':
                return sha1($salt . $value);
                break;
            case 'md5':
                return md5($value . $salt);
                break;
            default:
                return $value;
        }
    }

    public static function echopre()
    {
        $messages = func_get_args();
        if (empty($messages)) {
            return;
        }
        echo "<pre class='echopre' >";
        foreach ($messages as $m) {
            if (empty($m) && is_array($m)) {
                $m = "array(0) {}";
            } elseif (empty($m) && is_string($m)) {
                $m = 'string(0) ""';
            } elseif (empty($m) && is_bool($m)) {
                $m = $m ? "bool(true)" : "bool(false)";
            } elseif (empty($m)) {
                $m = gettype($m) . "($m)";
            }
            @print_r($m);
            echo "<br />";
        }
        echo"</pre>";
    }

    public static function bench(\Closure $test, $label = 'Benchmark')
    {
        $start = microtime()*1000;
        $test();
        $time = microtime()*1000 - $start;
        self::echopre($label . ": ", $time);
    }

    public static function varDump($m)
    {
        echo "<pre>";
        @print_r($m);
        echo"</pre>";
    }
}
