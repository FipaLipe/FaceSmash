

atualizaFoto("000000");
atualizaFoto("000001");


document.querySelectorAll(".pessoa").forEach((p) => {
    p.addEventListener('click', (e) => {
        pessoa = e.target;
        console.log(pessoa.id);
        atualizaFoto(pessoa.id);
    });
})

function atualizaFoto(id) {
    rm = randomRM();

    img = document.getElementById(id);

    img.src = linkDaFoto(rm);
    img.id = rm;

    img.onerror = function () {
        atualizaFoto(id); // Chama a função novamente se a imagem não carregar
    };
}

function randomRM(anoIni = 8, anoFim = 24, max = 600) {
    ano = Math.floor(Math.random() * (anoFim - anoIni) + anoIni);
    id = Math.floor(Math.random() * max);
    rm = ano.toString().padStart(2, '0') + id.toString().padStart(4, '0');

    return rm;
}

function linkDaFoto(rm) {
    return `https://professor.colegiopolitec.com.br/img/aluno/${rm}.jpg`
}