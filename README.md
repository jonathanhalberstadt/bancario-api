
# 📌 Bancário API

API RESTful para gestão bancária, desenvolvida em Laravel e Dockerizada para o teste técnico da empresa Objetive (https://rh-objective.s3.amazonaws.com/Desafio_Tecnico_OBJ.pdf).

A API permite a criação de contas, realização de transações e consulta de saldos, aplicando taxas conforme a forma de pagamento.

Por conta do enunciado estar em português, mantive tudo em linguagem nativa.

## 🛠 Tecnologias Utilizadas

- **PHP**: 8.x
- **Laravel**: 8.x ou superior
- **Docker & Docker Compose**
- **MySQL**
- **Composer**

## 🚀 Instalação e Configuração

## Dependências

- [GNU make](https://www.gnu.org/software/make/)
- [docker-engine](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/)
- [docker-compose](https://docs.docker.com/compose/install/)

### 1. Clonar o Repositório
```bash
git clone <URL do repositório>
cd bancario-api
```


### 2. Criar o Arquivo .env
```bash
cp .env.example .env
```

⚠️ **Configurar as variáveis do banco de dados e outros parâmetros necessários no arquivo `.env`.**

### 3. Construir e Rodar os Containers

```bash
make build
make up
```

### 4. Rodar as Migrações
```bash
make migration
```


## 📁 Estrutura do Projeto
```bash
bancario-api/
├── app/
│ ├── Models/
│ │ ├── Conta.php
│ │ ├── Transacao.php
│ ├── Repositories/
│ │ ├── ContaRepository.php
│ │ ├── TransacaoRepository.php
│ ├── Services/
│ │ ├── TransacaoService.php
│ ├── Http/
│ │ ├── Controllers/
│ │ │ ├── ContaController.php
│ │ │ ├── TransacaoController.php
│ ├── Factories/
│ │ ├── TaxaFactory.php
├── database/
│ ├── migrations/
│ │ ├── xxxx_create_contas_table.php
│ │ ├── xxxx_create_transacoes_table.php
├── docker-compose.yml
├── Makefile
└── README.md
```

## 🔗 Rotas da API

### Criar Conta

**POST** `/api/conta`

**Corpo da Requisição:**
```bash
{
"numero_conta": 3131,
"saldo": 100.00
}
```

**Resposta de Sucesso (201 Created):**
```bash
{
"numero_conta": 3131,
"saldo": 100.00
}
```

### Consultar Conta

**GET** `/api/conta?numero_conta=3131`

**Resposta de Sucesso (200 OK):**
```bash
{
"numero_conta": 3131,
"saldo": 100.00
}
```

**Erro (404 Not Found):** Conta não encontrada.

### Realizar Transação

**POST** `/api/transacao`

**Corpo da Requisição:**
```bash
{
"forma_pagamento": "C",
"numero_conta": 3131,
"valor": 40.47
}
```

**Resposta de Sucesso (201 Created):**
```bash
{
"numero_conta": 3131,
"saldo": 59.53
}
```

**Erro (400 Bad Request):** Erro ao processar transação.

## 🧪 Rodando os Testes

Para rodar os testes, utilize:
```bash
make test
```
Ou rode diretamente com Artisan:

```bash
php artisan test
```

## 📦 Gerenciamento do Container

- **Subir os containers:**
    ```
    make up 
    ```
- **Parar os containers:**
    ```
    make down 
    ```
- **Reiniciar:**
    ```
    make restart 
    ```
- **Ver logs:**
    ```
    make logs 
    ```
- **Acessar o container:**
    ```
    make exec 
    ```

## 🏁 Conclusão

O projeto `bancario-api` fornece uma API para operações bancárias, permitindo a criação de contas e realização de transações com diferentes taxas. O uso de Docker e um Makefile facilita a execução e testes do sistema.