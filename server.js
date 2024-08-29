// server.js
const express = require('express');
const path = require('path');
const app = express();
const port = 3000;

// Serve arquivos estáticos (HTML, CSS, JS) da pasta 'public'
app.use(express.static(path.join(__dirname, 'public')));

// Rota padrão
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// API
app.get('/api/', (req, res) => {
    const dados = {
        mensagem: 'Olá, mundo!',
        data: new Date()
    };
    res.json(dados);
});

// Inicia o servidor
app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});
