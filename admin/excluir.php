<?php
session_start();
// Proteção: Só deleta se estiver logado
if (!isset($_SESSION['usuario_id'])) { exit('Acesso negado'); }

require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/src/Avaliacao.php';
require_once dirname(__DIR__) . '/src/Usuario.php';
$id = $_GET['id'] ?? null;

if ($id) {
    $obj = new Avaliacao($pdo);
    $obj->excluir($id);
}

// Volta para o dashboard com uma mensagem de sucesso
header('Location: dashboard.php?status=removido');
exit;