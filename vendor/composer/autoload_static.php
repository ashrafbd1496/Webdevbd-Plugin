<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit758ec34690a7ab30d9fb3b1c069da70b
{
    public static $files = array (
        '14f8eced83bdf788181855ee0598253d' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Ashraf\\Webdevbd\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ashraf\\Webdevbd\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit758ec34690a7ab30d9fb3b1c069da70b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit758ec34690a7ab30d9fb3b1c069da70b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit758ec34690a7ab30d9fb3b1c069da70b::$classMap;

        }, null, ClassLoader::class);
    }
}
