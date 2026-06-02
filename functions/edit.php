<?php

require_once "lercampo.php";

system('clear');

if (empty($produtos)) {
    echo "Nenhum produto cadastrado.\n";
    readline("Aperte Enter para voltar...");
    system('clear');
    require 'index.php';
}

echo "------------------------------------------------------------\n";
echo "| Editar Produto (Aperte S para sair)                     |\n";
echo "------------------------------------------------------------\n";
echo "| Digite o ID do produto que deseja editar:               |\n";

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
echo "| Editando: {$produto['nome']}                            \n";
echo "| Deixe em branco para manter o valor atual               |\n";
echo "------------------------------------------------------------\n";

echo "| Nome atual: {$produto['nome']}\n";
$nome = trim(readline("> "));
if (!empty($nome)) {
    while (!ctype_alnum(str_replace(' ', '', $nome))) {
        echo "| Nome inválido. Use apenas letras e números.\n";
        echo "| Nome atual: {$produto['nome']}\n";
        $nome = trim(readline("> "));
    }
    $produto['nome'] = $nome;
}

echo "| Preço atual: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n";
$preco = trim(readline("> "));
if (!empty($preco)) {
    while (!is_numeric($preco) || (float)$preco < 0) {
        echo "| Preço inválido. Digite um número maior que zero.\n";
        echo "| Preço atual: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n";
        $preco = trim(readline("> "));
    }
    $produto['preco'] = (float) $preco;
}

echo "| Descrição atual: {$produto['descricao']}\n";
$descricao = trim(readline("> "));
if (!empty($descricao)) {
    while (strlen($descricao) < 3) {
        echo "| Descrição inválida. Mínimo de 3 caracteres.\n";
        echo "| Descrição atual: {$produto['descricao']}\n";
        $descricao = trim(readline("> "));
    }
    $produto['descricao'] = $descricao;
}

echo "| Quantidade atual: {$produto['quantidade']}\n";
$quantidade = trim(readline("> "));
if (!empty($quantidade)) {
    while (!ctype_digit($quantidade)) {
        echo "| Quantidade inválida. Digite um número inteiro.\n";
        echo "| Quantidade atual: {$produto['quantidade']}\n";
        $quantidade = trim(readline("> "));
    }
    $produto['quantidade'] = (int) $quantidade;
}

$produto['disponivel'] = $produto['quantidade'] > 0;

$produtos[$indice] = $produto;

echo "------------------------------------------------------------\n";
echo "| Confirma a edição do produto?                           |\n";
echo "| Sim ou Não                                              |\n";

while (true) {
    $confirmacao = strtolower(trim(readline("> ")));

    if (in_array($confirmacao, ['sim', 's'])) {
        file_put_contents($dataFile, json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        system('clear');
        echo "Produto editado com sucesso!\n";
        readline("Aperte Enter para voltar...");
        system('clear');
        require 'index.php';
        break;

    } else if (in_array($confirmacao, ['não', 'nao', 'n'])) {
        system('clear');
        echo "Edição cancelada.\n";
        readline("Aperte Enter para voltar...");
        system('clear');
        require 'index.php';
        break;

    } else {
        echo "| Opção inválida. Responda com 'Sim' ou 'Não'.\n";
    }
}