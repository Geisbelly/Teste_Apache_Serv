# 🖥️ Simulação de Servidores Web

### 📘 Atividade de Arquitetura de Computadores

**Autoras:**  
Geisbelly Victória dos Santos Feitosa Moraes  
Marian Antônia Alvez Curcino  

---

## 🎯 Objetivo

Analisar o comportamento de servidores web síncronos (PHP/Apache) e assíncronos (Node.js/Express), avaliando como cada um lida com:

- Requisições simultâneas
- Processos demorados
- Exceções no servidor

---

## 🧰 Tecnologias Utilizadas

### 🔹 Backend

- **PHP** (para servidor síncrono)
- **Node.js + Express** (para servidor assíncrono)

### 🔹 Ambiente

- **XAMPP** (para executar o servidor Apache + PHP localmente)
- **Node.js** instalado na máquina

### 🔹 Ferramentas de Teste

- `curl` via terminal
- `curl_multi_exec()` no PHP (para simular concorrência)
- Navegador e/ou Postman para testes manuais

---

## 🗂️ Estrutura da Atividade

AtividadeArquitetura/

├── index.php             → Página raiz do servidor

├── demorados.php         → Simula processo demorado (sleep)

├── excecao.php           → Gera uma exceção proposital

├── index2.php            → Faz requisições paralelas via cURL

├── node/

│   ├── projeto.js        → Versão em Node.js com rotas equivalentes

│   ├── package.json

│   └── package-lock.json


---

## 🧪 Testes Realizados

### 🔁 Execução com `sleep(50)`

**✅ Teste 1 — `/` depois de `/demorado.php`**  
⏱️ Tempo total: **50.0200 segundos**

**✅ Teste 2 — `/demorado.php` depois de `/`**  
⏱️ Tempo total: **50.0036 segundos**

**✅ Teste 3 — `/excecao.php` depois de `/`**  
⏱️ Tempo total: **0.0039 segundos**

---

### 🔁 Execução com `sleep(30)`

**✅ Teste 1 — `/` depois de `/demorado.php`**  
⏱️ Tempo total: **30.0258 segundos**

**✅ Teste 2 — `/demorado.php` depois de `/`**  
⏱️ Tempo total: **30.0180 segundos**

**✅ Teste 3 — `/excecao.php` depois de `/`**  
⏱️ Tempo total: **0.0018 segundos**

---

### 📊 Tempos Individuais

| Rota              | Tempo de Execução |
|-------------------|-------------------|
| `/`               | `0.0008 s`        |
| `/demorado.php`   | `30.0147 s`       |
| `/excecao.php`    | `0.0173 s`        |


---

## 📈 Conclusão

- Mesmo em um ambiente tradicionalmente **síncrono como PHP**, conseguimos **simular execução paralela** com `curl_multi_exec()`.
- O tempo total das requisições paralelas sempre se aproxima do tempo da requisição **mais lenta**, o que confirma que o servidor respondeu **concorrentemente**.
- Com Node.js, o comportamento assíncrono é nativo e esperado, permitindo respostas simultâneas mesmo com requisições demoradas ou bloqueantes.

---

## 📌 Observações

- Os testes foram realizados em ambiente local.
- Para aumentar a confiabilidade, foi feita a média de múltiplas execuções.
- O tempo das requisições pode variar conforme o desempenho do sistema.

---

## 🚀 Como Executar

### ▶ PHP (Apache com XAMPP)

1. Copie os arquivos `.php` para o diretório `htdocs` do XAMPP.
2. Inicie o Apache via painel do XAMPP.
3. Acesse pelo navegador: `http://localhost/AtividadeArquitetura/index2.php` -- Disponibilizado para testes

### ▶ Node.js

1. Acesse a pasta `/node`
2. Instale as dependências com:
   ```bash
   npm install
3. Depois node projeto.js

4. Acesse: http://localhost:3000/

