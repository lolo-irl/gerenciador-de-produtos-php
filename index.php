<?php

$dataFile = "DB/produtos.json";

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$produtos = json_decode(file_get_contents($dataFile), true);

while (true) {

echo "----------------------------------------\n";
echo "| Sistema de Gerenciamento de Produtos |\n";
echo "----------------------------------------\n";
echo "| 1. Cadastrar Produto                 |\n";
echo "| 2. Listar Produto                    |\n";
echo "| 3. Buscar Produto                    |\n";
echo "| 4. Editar Produto                    |\n";
echo "| 5. Excluir Produto                   |\n";
echo "| 6. Estatísticas                      |\n";
echo "| 7. Sair                              |\n";
echo "----------------------------------------\n";
echo "| Digite uma opção:                    |\n";

$input = readline("> ");

$action = match ($input) {
    '1' => function () use ($dataFile, $produtos) {
        system('clear');
        require 'functions/cadastro.php';
    },

    '2' => function () use ($dataFile, $produtos) {
        system('clear');
        require 'functions/listar.php';
    },

    '3' => function () use ($dataFile, $produtos) {
        system('clear');
        require 'functions/busca.php';
    },

    '4' => function () use ($dataFile, $produtos)    {
        system('clear');
        require 'functions/edit.php';
    },

    '5' => function () use ($dataFile, $produtos) {
        system('clear');
        require 'functions/excluir.php';
    },

    '6' => function () use ($dataFile, $produtos)    {
        system('clear');
        require 'functions/stats.php';
    },

    '7' => function () {
        system('clear');
        echo "\nSaindo do gerenciador. Até mais!\n";
        exit(0);    
    },

    default => function () {
        system('clear');
        echo "Opção inválida. Por favor, tente novamente.\n";
    },
};

$action();

}
?>