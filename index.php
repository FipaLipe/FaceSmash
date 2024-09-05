<?php

require "utilities/conexao.php";
require "utilities/get_img.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facemash</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>FACEMASH</h1>
    </div>
    <div class="main">
        <h1>Clique para escolher um</h1>
        <?php
            try {
                $aluno1 = get_img($conn, "000000");
                $aluno2 = get_img($conn, $aluno1["rm"]);
            }
            catch (Exception $e) {
                echo "Erro: " . $e;
            }
        ?>
        <div class="escolhas">
            <div class="pessoa">
                <img id="1" src="<?php echo $aluno1["img"]; ?>">
            </div>
            <h2>or</h2>
            <div class="pessoa" id="pessoa2">
                <img id="2" src="<?php echo $aluno2["img"]; ?>">
            </div>  
        </div>

    </div>
</body>
</html>