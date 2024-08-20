<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbacb6f488dcc12a4bb6603df74bb759b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitbacb6f488dcc12a4bb6603df74bb759b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbacb6f488dcc12a4bb6603df74bb759b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbacb6f488dcc12a4bb6603df74bb759b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
