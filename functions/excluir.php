<?php

$dataFile = "DB/produtos.json";
$produtos = json_decode(file_get_contents($dataFile), true);

system('clear');

if (empty($produtos)) {
    echo "Nenhum produto cadastrado.\n";
    readline("Aperte Enter para voltar...");
    system('clear');
    require 'index.php';
}

echo "------------------------------------------------------------\n";
echo "| Deletar Produto (Aperte S para sair)                    |\n";
echo "------------------------------------------------------------\n";
echo "| Digite o ID do produto que deseja deletar:              |\n";

$inputId = trim(readline("> "));

if (strtolower($inputId) === 's') {
    system('clear');
    require 'index.php';
}

$indice = null;
foreach ($produtos as $i => $p) {
    if ($p['id'] == $inputId) {
        $indice = $i;
        break;
    }
}

if ($indice === null) {
    system('clear');
    echo "Produto com ID \"$inputId\" não encontrado.\n";
    readline("Aperte Enter para voltar...");
    system('clear');
    require 'index.php';
}

$produto = $produtos[$indice];

system('clear');

echo "------------------------------------------------------------\n";
echo "| Produto encontrado:                                     |\n";
echo "------------------------------------------------------------\n";
echo "| ID: {$produto['id']}\n";
echo "| Nome: {$produto['nome']}\n";
echo "| Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n";
echo "| Descrição: {$produto['descricao']}\n";
echo "| Quantidade: {$produto['quantidade']}\n";
echo "| Disponível: " . ($produto['disponivel'] ? 'Sim' : 'Não') . "\n";
echo "------------------------------------------------------------\n";
echo "| Confirma a exclusão do produto?                         |\n";
echo "| Sim ou Não                                              |\n";

while (true) {
    $confirmacao = strtolower(trim(readline("> ")));

    if (in_array($confirmacao, ['sim', 's'])) {

        array_splice($produtos, $indice, 1);

        file_put_contents($dataFile, json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        system('clear');
        echo "Produto \"{$produto['nome']}\" deletado com sucesso!\n";
        readline("Aperte Enter para voltar...");
        system('clear');
        require 'index.php';
        break;

    } else if (in_array($confirmacao, ['não', 'nao', 'n'])) {
        system('clear');
        echo "Exclusão cancelada.\n";
        readline("Aperte Enter para voltar...");
        system('clear');
        require 'index.php';
        break;

    } else {
        echo "| Opção inválida. Responda com 'Sim' ou 'Não'.\n";
    }
}