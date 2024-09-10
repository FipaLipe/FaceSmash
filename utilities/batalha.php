<?php

require "conexao.php";

try {
    $data = json_decode(file_get_contents('php://input'), true);

    $ganhador = $data["ganhador"];
    $perdedor = $data["perdedor"];
    $pontos = [$ganhador => 0, $perdedor => 0];
    $novos_pontos = [$ganhador => 0, $perdedor => 0];

    $stmt = $conn->prepare('SELECT rm, pontos FROM alunos WHERE rm in (:ganhador, :perdedor)');
    $stmt->bindParam(':ganhador', $ganhador);
    $stmt->bindParam(':perdedor', $perdedor);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $aluno) {
        $pontos[$aluno["rm"]] = $aluno["pontos"];
    }

    $EA = 1 / (1 + pow(10,($pontos[$perdedor] - $pontos[$ganhador])/400));
    $EB = 1 / (1 + pow(10,($pontos[$ganhador] - $pontos[$perdedor])/400));

    $novos_pontos[$ganhador] = round($pontos[$ganhador] + 32 * (1-$EA));
    $novos_pontos[$perdedor] = round($pontos[$perdedor] + 32 * (0-$EB));
    
    $stmt = $conn->prepare('INSERT INTO batalhas(ganhador, perdedor) VALUES(:ganhador,:perdedor)');
    $stmt->bindParam(':ganhador', $ganhador);
    $stmt->bindParam(':perdedor', $perdedor);
    $stmt->execute();

    $stmt = $conn->prepare('UPDATE alunos SET pontos = :pontos WHERE rm = :ganhador');
    $stmt->bindParam(':pontos', $novos_pontos[$ganhador]);
    $stmt->bindParam(':ganhador', $ganhador);
    $stmt->execute();
    
    $stmt = $conn->prepare('UPDATE alunos SET pontos = :pontos WHERE rm = :perdedor');
    $stmt->bindParam(':pontos', $novos_pontos[$perdedor]);
    $stmt->bindParam(':perdedor', $perdedor);
    $stmt->execute();
}
catch (Exception $e) {
    echo "Erro na batalha: " . $e;
}

?>