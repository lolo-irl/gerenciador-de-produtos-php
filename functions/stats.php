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

$totalProdutos    = count($produtos);
$totalQuantidade  = array_sum(array_column($produtos, 'quantidade'));
$totalDisponiveis = count(array_filter($produtos, fn($p) => $p['disponivel'] === true));

$faixa1 = 0; // R$ 0,01 até R$ 25,00
$faixa2 = 0; // R$ 25,01 até R$ 100,00
$faixa3 = 0; // R$ 100,01 até R$ 500,00
$faixa4 = 0; // Acima de R$ 500,00

foreach ($produtos as $produto) {
    $preco = (float) $produto['preco'];

    if ($preco >= 0.01 && $preco <= 25) {
        $faixa1++;
    } else if ($preco > 25 && $preco <= 100) {
        $faixa2++;
    } else if ($preco > 100 && $preco <= 500) {
        $faixa3++;
    } else if ($preco > 500) {
        $faixa4++;
    }
}

echo "------------------------------------------------------------\n";
echo "| Estatísticas                                            |\n";
echo "------------------------------------------------------------\n";
echo "| Total de produtos cadastrados : $totalProdutos\n";
echo "| Total de itens em estoque     : $totalQuantidade\n";
echo "| Produtos disponíveis          : $totalDisponiveis\n";
echo "| Produtos indisponíveis        : " . ($totalProdutos - $totalDisponiveis) . "\n";
echo "------------------------------------------------------------\n";
echo "| Faixas de preço                                         |\n";
echo "------------------------------------------------------------\n";
echo "| R$ 0,01  até R$ 25,00  : $faixa1 produto(s)\n";
echo "| R$ 25,01 até R$ 100,00 : $faixa2 produto(s)\n";
echo "| R$ 100,01 até R$ 500,00: $faixa3 produto(s)\n";
echo "| Acima de R$ 500,00     : $faixa4 produto(s)\n";
echo "------------------------------------------------------------\n";

readline("Aperte Enter para voltar...");
system('clear');
require 'index.php';
