<?php

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    $pdo = new PDO("mysql:dbname=".$_ENV["MYSQL_DATABASE"].";host=".$_ENV["MYSQL_HOST"],$_ENV["MYSQL_USER"],$_ENV["MYSQL_PASSWORD"]);
}
catch (PDOException $e) {
    echo "Erro no banco: " . $e->getMessage();
}
catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

?>