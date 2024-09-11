<?php

require "utilities/conexao.php";

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
        <h1>FACEMASH</h1>
    </div>
    <div class="main">
        <h1>Clique para escolher um</h1>
        <div class="escolhas">
            <div class="pessoa">
                <img id="0" src="assets/img/default.jpg">
            </div>
            <h2>or</h2>
            <div class="pessoa" id="pessoa2">
                <img id="1" src="assets/img/default.jpg">
            </div>  
        </div>

    </div>

    <footer>
        <a href="/ranking">Veja o ranking atual  </a>|<a href="/remove">  Desejo remover minha foto</a>
    </footer>

    <script>
        alunos = ["",""]
        
        async function start() {
            await atualizaFoto("0", false);
            await atualizaFoto("1", false);
        };

        document.querySelectorAll(".pessoa").forEach((p) => {
            p.addEventListener('click', (e) => {
                batalha(alunos, e.target.id)
                atualizaFoto({"0":"1","1":"0"}[e.target.id])
            });
        });

        function delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        function batalha(alunos, ganhador) {
            fetch('utilities/batalha.php', {
                method: 'POST', // Definir o método HTTP como POST
                headers: {
                    'Content-Type': 'application/json', // Tipo de conteúdo dos dados
                },
                body: JSON.stringify({
                    ganhador: alunos[ganhador],
                    perdedor: alunos[{'0':'1','1':'0'}[ganhador]]
                }) // Dados a serem enviados no corpo da requisição
            })
        }

        function atualizaFoto(id, temDelay=true) {
            return new Promise(async (resolve) => {
                img = document.getElementById(id);

                if (temDelay) {
                    img.style.filter = 'grayscale(100%)';
                    await delay(400);
                };

                fetch("utilities/get_img.php")
                .then(response => response.json())
                .then(aluno => {
                    //console.log(`Atualizando a foto ${id} pro aluno ${aluno.rm}`);
                    if (aluno) {
                        alunos[id] = aluno.rm;
                        img.src = aluno.img;
                        img.style.filter = 'none';
                        img.style.width = '15rem'; 
                        img.style.height = '20rem'; 
                        img.style.objectFit = 'cover';
                    }
                    resolve();
                });
            });
        }

        
        document.addEventListener("DOMContentLoaded", (e) => {
            start();
        })
    </script>
</body>
</html>