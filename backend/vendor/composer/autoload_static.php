<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit06c31307846a707afaecf0769d575319
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..',
        '3109cb1a231dcd04bee1f9f620d46975' => __DIR__ . '/..',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pusher\\' => 7,
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pusher\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..',
            1 => __DIR__ . '/..',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit06c31307846a707afaecf0769d575319::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit06c31307846a707afaecf0769d575319::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit06c31307846a707afaecf0769d575319::$classMap;

        }, null, ClassLoader::class);
    }
}