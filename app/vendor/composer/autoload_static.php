<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdac7b3688073841b140e0aede5a1f19b
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BenMorel\\ApacheLogParser\\' => 25,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BenMorel\\ApacheLogParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/benmorel/apache-log-parser/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdac7b3688073841b140e0aede5a1f19b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdac7b3688073841b140e0aede5a1f19b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdac7b3688073841b140e0aede5a1f19b::$classMap;

        }, null, ClassLoader::class);
    }
}