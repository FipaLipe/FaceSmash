<?php

require realpath(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    $conn = new PDO("mysql:dbname=".$_ENV["MYSQL_DATABASE"].";host=".$_ENV["MYSQL_HOST"],$_ENV["MYSQL_USER"],$_ENV["MYSQL_PASSWORD"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Erro no banco: " . $e->getMessage();
}
catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

?>