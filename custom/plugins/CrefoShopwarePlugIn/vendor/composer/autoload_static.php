<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5988c48d145f3a27fe2959d25cbaaa0a
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '27c26b02b2b408b69b0a5ff12f746b77' => __DIR__ . '/../..' . '/autoload.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'D' => 
        array (
            'Defuse\\Crypto\\' => 14,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Defuse\\Crypto\\' => 
        array (
            0 => __DIR__ . '/..' . '/defuse/php-encryption/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5988c48d145f3a27fe2959d25cbaaa0a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5988c48d145f3a27fe2959d25cbaaa0a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
