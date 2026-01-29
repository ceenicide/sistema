<?php
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/src/Avaliacao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj = new Avaliacao($pdo);
    
    $sucesso = $obj->salvar(
        $_POST['nota_comida'],
        $_POST['nota_atendimento'],
        $_POST['nota_geral'],
        $_POST['comentario']
    );

    if ($sucesso) {
        header('Location: obrigado.php');
    } else {
        echo "Erro ao salvar.";
    }
}