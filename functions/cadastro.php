<?php

if (!isset($produtos)){
    $produtos = [];
}

$id = 1;
if (!empty($produtos)) {
    $maxId = max(array_column($produtos, 'id'));
    $id = $maxId + 1;
}

require_once 'lercampo.php';

while (true) {
    system('clear');

    echo "------------------------------------------------------------\n";
    echo "| Cadastro de Produto (Aperte S para sair)                 |\n";
    echo "------------------------------------------------------------\n";

    $nome = lerCampo(
        'Nome',
        fn($v) => !empty(trim($v)) && ctype_alnum(str_replace(' ', '', $v)),
        'Nome inválido. Use apenas letras e números.'
    );

    $preco = lerCampo(
        'Preço',
        fn($v) => is_numeric($v) && (float)$v > 0,
        'Preço inválido. Digite um número maior que zero.'
    );

    $descricao = lerCampo(
        'Descrição',
        fn($v) => !empty(trim($v)) && strlen(trim($v)) >= 3,
        'Descrição inválida. Mínimo de 3 caracteres.'
    );

    $quantidade = lerCampo(
        'Quantidade',
        fn($v) => ctype_digit($v) && (int)$v > 0,
        'Quantidade inválida. Digite um número inteiro maior que zero.'
    );

    $disponivel = (int)$quantidade > 0;

echo "------------------------------------------------------------\n";
echo "| Confirma o cadastro do produto?                          |\n";
echo "| Sim ou Não                                               |\n";

while (true) {
    $confirmacao = strtolower(trim(readline("> ")));

    if (in_array($confirmacao, ['sim', 's'])) {

        $produto = [
            "id" => $id,
            "nome" => $nome,
            "preco" => (float) $preco,
            "descricao" => $descricao,
            "quantidade"=> (int) $quantidade,
            "disponivel"=> $disponivel
        ];

        $produtos[] = $produto;

        file_put_contents($dataFile, json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        system('clear');
        echo "Produto cadastrado com sucesso!\n";
        require 'index.php';
        break;

    } else if (in_array($confirmacao, ['não', 'nao', 'n'])) {
        system('clear');
        echo "Cadastro do produto cancelado.\n";
        break;

    } else {
        echo "| Opção inválida. Responda com 'Sim' ou 'Não'.\n";
    }
}

}

?>