RMs = {
    "1": "1",
    "2": "2"
}


async function start() {
    //console.log("COMECOU");
    await atualizaFoto("1");
    await atualizaFoto("2");
};


document.querySelectorAll(".pessoa").forEach((p) => {
    p.addEventListener('click', async (e) => {
        pessoa = e.target;
        switch(pessoa.id){
            case '1':
                await atualizaFoto("2");
                break;
            case '2':
                await atualizaFoto("1");
                break;
        }
    });
});

async function atualizaFoto(id) {
    img = document.getElementById(id);
    img.style.filter = 'grayscale(100%)';
    rm = await randomRM();

    existe = await esseManoExiste(linkDaFoto(rm))

    if (existe) {
        //console.log(`foi pro mano ${rm}`)
        img.src = linkDaFoto(rm);
        RMs[id] = rm;
        img.style.filter = 'none';
        img.style.width = '15rem'; 
        img.style.height = '20rem'; 
        img.style.objectFit = 'cover';
    } else {
        //console.log(`foi não pro mano ${rm}`)
        atualizaFoto(id)
    }
}

function randomRM(anoIni = 8, anoFim = 24, max = 600) {
    ano = Math.floor(Math.random() * (anoFim - anoIni) + anoIni);
    id = Math.floor(Math.random() * max);
    rm = ano.toString().padStart(2, '0') + id.toString().padStart(4, '0');
    return rm;
};

function linkDaFoto(rm) {
    return `https://professor.colegiopolitec.com.br/img/aluno/${rm}.jpg`
}

function esseManoExiste(url, callback) {
    return new Promise((resolve, reject) => {
        var img = new Image();
        img.onload = function () { resolve(true); };
        img.onerror = function () { resolve(false); };
        img.src = url;
    });
}

document.addEventListener("DOMContentLoaded", (e) => {
    start();
})
