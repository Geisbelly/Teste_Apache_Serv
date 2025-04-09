const express = require('express');
const app = express();
const port = 3000;


app.get('/', (req, res) => {
  res.send('Rota raiz: tudo funcionando!');
});


app.get('/demorado', async (req, res) => {
  console.log('Iniciando rota demorada...');
  await new Promise(resolve => setTimeout(resolve, 60000)); 
  res.send('Rota demorada finalizada após 1 minuto.');
});


app.get('/excecao', (req, res) => {
  throw new Error('Erro proposital gerado na rota /excecao');
});


app.use((err, req, res, next) => {
  console.error('Erro capturado:', err.message);
  res.status(500).send('Ocorreu um erro no servidor!');
});

app.listen(port, () => {
  console.log(`Servidor Node rodando em http://localhost:${port}`);
});
