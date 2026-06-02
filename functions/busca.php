<?php

system('clear');

if (empty($produtos)) {
    echo "Nenhum produto cadastrado.\n";
    readline("Aperte Enter para voltar...");
    system('clear');
    require 'index.php';
}

echo "------------------------------------------------------------\n";
echo "| Buscar Produto (Aperte S para sair)                     |\n";
echo "------------------------------------------------------------\n";
echo "| Digite o nome do produto:                               |\n";

$busca = strtolower(trim(readline("> ")));

if (strtolower($busca) === 's') {
    system('clear');
    require 'index.php';
}

$encontrados = array_filter($produtos, fn($p) => str_contains(strtolower($p['nome']), $busca));

system('clear');

if (empty($encontrados)) {
    echo "Nenhum produto encontrado com o termo: \"$busca\"\n";
} else {
    echo "------------------------------------------------------------\n";
    echo "| Resultados para: \"$busca\"\n";
    echo "------------------------------------------------------------\n";

    foreach ($encontrados as $produto) {
        echo "| ID: {$produto['id']}\n";
        echo "| Nome: {$produto['nome']}\n";
        echo "| Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n";
        echo "| Descrição: {$produto['descricao']}\n";
        echo "| Quantidade: {$produto['quantidade']}\n";
        echo "| Disponível: " . ($produto['disponivel'] ? 'Sim' : 'Não') . "\n";
        echo "------------------------------------------------------------\n";
    }
}

readline("Aperte Enter para voltar...");
system('clear');
require 'index.php';


?>
