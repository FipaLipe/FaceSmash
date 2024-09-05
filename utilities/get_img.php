<?php

require "conexao.php";

function get_img($conn, $aluno = "000000") {
    try {
        $img = $conn->query('SELECT * FROM alunos WHERE status = "A" ORDER BY rand() LIMIT 1');
    
        // foreach($img as $row) {
        //     foreach ($row as $col) {
        //         echo $col . " | ";
        //     }
        //     echo "<br>";
        // }

        $result = $img->fetchAll(PDO::FETCH_ASSOC)[0];
    
        if ($result["rm"] == $aluno) {
            return get_img($conn, $aluno);
        } else {
            return $result;
        }
    }
    catch (Exception $e) {
        echo "Erro no get_img: " . $e;
    }
}

?>