<?php
    use \Doctrine\Common\Annotations\AnnotationReader;
    use \Doctrine\Common\Annotations\AnnotationRegistry;
    
    require_once __DIR__ . '/../vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php'; // with PEAR
    // Setup Autoloader (1)
    // Define application environment
    define('APPLICATION_ENV', "development");
    error_reporting(E_ALL);
    /*
      defined('APPLICATION_ENV')
      || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
     */
    // Autoloader (1)
    $classLoader = new \Doctrine\Common\ClassLoader('Doctrine');
    $classLoader->register();

    $classLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__);
    $classLoader->register();
    $classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__);
    $classLoader->register();

    // configuration (2)
    $config = new \Doctrine\ORM\Configuration();

    // Proxies (3)
    $config->setProxyDir(__DIR__ . '/data/Proxies');
    $config->setProxyNamespace('Proxies');

    $config->setAutoGenerateProxyClasses((APPLICATION_ENV == "development"));

    AnnotationRegistry::registerFile(__DIR__ . '/../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
    $reader = new AnnotationReader();
    
    // Driver (4)
    $driverImpl = $config->newDefaultAnnotationDriver($reader, array(__DIR__ . DIRECTORY_SEPARATOR . "/../Entities"));
    $config->setMetadataDriverImpl($driverImpl);

    // Caching Configuration (5)
    if (APPLICATION_ENV == "development") {
        $cache = new \Doctrine\Common\Cache\ArrayCache();
    } else {
        $cache = new \Doctrine\Common\Cache\ApcCache();
    }

    $config->setMetadataCacheImpl($cache);
    $config->setQueryCacheImpl($cache);

    $connectionOptions = array(
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'busmap',
        'user' => 'root',
        'password' => 'mysql');

    $em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);
    $platform = $em->getConnection()->getDatabasePlatform();
    $platform->registerDoctrineTypeMapping('enum', 'string');
    
    $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
                'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
                'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
            ));
?>