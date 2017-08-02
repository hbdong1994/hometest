<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/9/009
 * Time: 14:40
 */

class Singleton
{
    private static $singleton = null;
    private function __construct()
    {
    }
    public static function getSingleton()
    {
        if (self::$singleton == null) {
            self::$singleton = new Singleton();
        }
        return self::$singleton;
    }
}

class Singleton1
{
    private $singleton;
}

$singleton1 = Singleton::getSingleton();
$singleton2 = Singleton::getSingleton();
//$singleton1 = new Singleton1();
//$singleton2 = new Singleton1();

if ($singleton1 === $singleton2) {
    echo '1221';
} else {
    echo '21341';
}