<?php

$url = explode('?',$_SERVER['REQUEST_URI']);
$l = isset($url[1]) ? $url[1] : 10;

switch ($url[0]) {
    case '/' :
        require __DIR__ . '/home.php';
        break;
    case '/ranking' :
        require __DIR__ . '/ranking.php';
        break;
    case '/remove' :
        require __DIR__ . '/remove.php';
        break;
    default:
        http_response_code(404);
        echo "<h1>404 Tá doidão zé?</h1>";
        break;
}

?>