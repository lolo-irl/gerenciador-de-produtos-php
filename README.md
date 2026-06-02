# Sistema de Gerenciamento de Produtos

Sistema de gerenciamento de produtos via terminal desenvolvido em **PHP puro**, sem frameworks ou bibliotecas externas. Os dados são persistidos em um arquivo `.json` local.

---

## Funcionalidades

- **Cadastrar** produto com nome, preço, descrição e quantidade
- **Listar** todos os produtos cadastrados
- **Buscar** produto por nome
- **Editar** informações de um produto existente
- **Deletar** um produto cadastrado
- **Estatísticas** gerais do estoque com faixas de preço

---

## Estrutura do Projeto

```
Projeto PHP/
├── index.php               # Menu principal
├── DB/
│   └── produtos.json       # Banco de dados local
└── functions/
    ├── cadastro.php        # Cadastro de produtos
    ├── listar.php          # Listagem de produtos
    ├── buscar.php          # Busca por nome
    ├── editar.php          # Edição de produtos
    ├── deletar.php         # Exclusão de produtos
    ├── estatisticas.php    # Estatísticas do estoque
    └── lercampo.php        # Função auxiliar de validação de input
```

---

## Como executar

### Pré-requisitos

- PHP 8.0 ou superior instalado
- Extensão `readline` habilitada (padrão no Linux/Mac)

### Rodando o projeto

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
php index.php
```

---

## O que foi utilizado?

- PHP 8.0+ puro (sem frameworks)
- JSON como banco de dados local

---

## Observações

- Projeto desenvolvido para fins de aprendizado de PHP CLI
- Todos os dados são salvos localmente no arquivo `DB/produtos.json`
- A disponibilidade do produto é calculada automaticamente com base na quantidade em estoque
