<?php

require "utilities/conexao.php";

$limit = isset($_GET['l']) ? $limit = $_GET['l'] : $limit = 10;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facemash</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="header">
        <h1>RANKING</h1>
    </div>
    <div class="main">
        <div class="alunos">
            <?php
            $i = 1;
            $stmt = $conn->prepare("SELECT * FROM alunos ORDER BY pontos DESC LIMIT :l");
            $stmt->bindParam(':l', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $aluno) {
            ?>
            <div class="aluno-card" style="background-image: url(<?php echo $aluno["img"];?>);">
                <div class="rank">#<?php echo $i; $i++; ?><h2></div>
            </div>
            <?php } ?>

        </div>
    </div>

    
    <footer>
        <a href="/">Voltar à HOME</a>
    </footer>
</body>
</html>