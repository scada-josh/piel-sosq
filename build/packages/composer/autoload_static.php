<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0584b30e0cb4addd2336e392b49be3ed
{
    public static $files = array (
        '17fd9fef37c97cfdc0c7794299a8423d' => __DIR__ . '/..' . '/vrana/notorm/NotORM.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Slim\\Middleware\\' => 16,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'E' => 
        array (
            'ElephantIO\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Slim\\Middleware\\' => 
        array (
            0 => __DIR__ . '/..' . '/tuupola/slim-jwt-auth/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'ElephantIO\\' => 
        array (
            0 => __DIR__ . '/..' . '/wisembly/elephant.io/src',
            1 => __DIR__ . '/..' . '/wisembly/elephant.io/test',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 
            array (
                0 => __DIR__ . '/..' . '/psr/log',
            ),
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
        'B' => 
        array (
            'Blablacar' => 
            array (
                0 => __DIR__ . '/..' . '/blablacar/memcached-client/src',
            ),
        ),
    );

    public static $classMap = array (
        'XMLSchema' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.xmlschema.php',
        'nusoap_base' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.nusoap_base.php',
        'nusoap_client' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soapclient.php',
        'nusoap_client_mime' => __DIR__ . '/..' . '/fergusean/nusoap/lib/nusoapmime.php',
        'nusoap_fault' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_fault.php',
        'nusoap_parser' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_parser.php',
        'nusoap_server' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_server.php',
        'nusoap_server_mime' => __DIR__ . '/..' . '/fergusean/nusoap/lib/nusoapmime.php',
        'nusoap_wsdlcache' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.wsdlcache.php',
        'nusoap_xmlschema' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.xmlschema.php',
        'nusoapservermime' => __DIR__ . '/..' . '/fergusean/nusoap/lib/nusoapmime.php',
        'soap_fault' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_fault.php',
        'soap_parser' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_parser.php',
        'soap_server' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_server.php',
        'soap_transport_http' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_transport_http.php',
        'soapclient' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soapclient.php',
        'soapclientmime' => __DIR__ . '/..' . '/fergusean/nusoap/lib/nusoapmime.php',
        'soapval' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.soap_val.php',
        'wsdl' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.wsdl.php',
        'wsdlcache' => __DIR__ . '/..' . '/fergusean/nusoap/lib/class.wsdlcache.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0584b30e0cb4addd2336e392b49be3ed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0584b30e0cb4addd2336e392b49be3ed::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0584b30e0cb4addd2336e392b49be3ed::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit0584b30e0cb4addd2336e392b49be3ed::$classMap;

        }, null, ClassLoader::class);
    }
}
