<?php

function lerCampo(string $label, callable $validador, string $msgErro): string
{
    while (true) {
        echo "| $label\n";
        $valor = readline("> ");

        if (strtolower($valor) === 's') {
            system('clear');
            require 'index.php';
            exit;
        }

        if ($validador($valor)) {
            return $valor;
        }

        echo "| ERRO: $msgErro\n";
    }
}

?>