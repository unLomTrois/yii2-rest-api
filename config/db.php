<?php

$url = parse_url(getenv("DATABASE_URL"));

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host='.$url['host'].';port='.$url['port'].';dbname='.substr($url["path"], 1),
    'username' => $url['user'],
    'password' => $url['pass'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
