<?php
function getDbConnection() {
    if (getenv('PLATFORM_RELATIONSHIPS')) {
        $relationships = json_decode(base64_decode(getenv('PLATFORM_RELATIONSHIPS')), true);
        $dbConfig = $relationships['database'][0];
        
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $dbConfig['host'], $dbConfig['port'], $dbConfig['path']
        );
        $username = $dbConfig['username'];
        $password = $dbConfig['password'];
    } else {
        $dsn = 'mysql:host=127.0.0.1;dbname=masv_paas_db;charset=utf8mb4';
        $username = 'root';
        $password = '';
    }

    return new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
