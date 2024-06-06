<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc42b26b0c18942951a97eaf779fb7d92
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc42b26b0c18942951a97eaf779fb7d92::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc42b26b0c18942951a97eaf779fb7d92::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc42b26b0c18942951a97eaf779fb7d92::$classMap;

        }, null, ClassLoader::class);
    }
}
