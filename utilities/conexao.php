<?php

try {
    $pdo = new PDO("mysql:dbname=".getenv("MYSQL_DATABASE").";host=".getenv("MYSQL_HOST"),getenv("MYSQL_USER"),getenv("MYSQL_PASSWORD"));
}
catch (PDOException $e) {
    echo "Erro no banco: " . $e->get_message();
}
catch (Exception $e) {
    echo "Erro: " . $e->get_message();
}

?>