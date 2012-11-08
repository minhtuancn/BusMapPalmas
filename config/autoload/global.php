<?php

return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn'    => 'mysql:dbname=busmap;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF-8\''
        )
    )
);
