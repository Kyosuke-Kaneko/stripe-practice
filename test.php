<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();                      // .envファイルから環境変数を読み込み

// 通常の環境変数を同じように下記のどの方法でも環境変数を呼び出せます

echo $host;
echo $_ENV["MYNAME"];