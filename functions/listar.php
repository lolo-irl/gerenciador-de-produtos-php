<?php

if (empty($produtos)) {
    echo "Nenhum produto cadastrado.\n";
    readline("Aperte Enter para voltar...");
    system('clear');
    require 'index.php';
}

system('clear');

echo "------------------------------------------------------------\n";
echo "| Lista de Produtos                                        |\n";
echo "------------------------------------------------------------\n";

foreach ($produtos as $produto) {
    echo "| ID: {$produto['id']}\n";
    echo "| Nome: {$produto['nome']}\n";
    echo "| Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n";
    echo "| Descrição: {$produto['descricao']}\n";
    echo "| Quantidade: {$produto['quantidade']}\n";
    echo "| Disponível: " . ($produto['disponivel'] ? 'Sim' : 'Não') . "\n";
    echo "------------------------------------------------------------\n";
}

readline("Aperte Enter para voltar...");
system('clear');
require 'index.php';

?>