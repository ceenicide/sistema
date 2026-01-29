<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) { header('Location: login.php'); exit; }

require_once dirname(dirname(__DIR__)) . '/config/database.php';
require_once dirname(dirname(__DIR__)) . '/src/Avaliacao.php';

// Busca a média das notas
$stats = $pdo->query("SELECT 
    AVG(nota_comida) as media_comida, 
    AVG(nota_atendimento) as media_atendimento, 
    AVG(nota_geral) as media_geral,
    COUNT(*) as total 
    FROM avaliacoes")->fetch(PDO::FETCH_ASSOC);



$obj = new Avaliacao($pdo);
$avaliacoes = $obj->listarTodas();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Avaliações</title>
    <style>
    .stats-container { display: flex; gap: 20px; margin-bottom: 30px; }
    .stat-card { background: #fff; padding: 20px; border-radius: 8px; flex: 1; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-top: 5px solid #27ae60; }
    .stat-card h3 { margin: 0; color: #7f8c8d; font-size: 0.9em; text-transform: uppercase; }
    .stat-card p { font-size: 2em; margin: 10px 0 0; font-weight: bold; color: #2c3e50; }
</style>
</head>
<body>
    <div class="header">
        <h1>Avaliações Recebidas</h1>
        <a href="logout.php" class="btn-logout">Sair do Painel</a>
    </div>

    <?php foreach ($avaliacoes as $av): ?>
    <div class="stats-container">
    <div class="stat-card">
        <h3>Total de Votos</h3>
        <p><?= $stats['total'] ?></p>
    </div>
    <div class="stat-card">
        <h3>Média Comida</h3>
        <p><?= number_format($stats['media_comida'], 1) ?> ⭐</p>
    </div>
    <div class="stat-card">
        <h3>Média Atendimento</h3>
        <p><?= number_format($stats['media_atendimento'], 1) ?> ⭐</p>
    </div>
    <div class="stat-card">
        <h3>Média Geral</h3>
        <p><?= number_format($stats['media_geral'], 1) ?> ⭐</p>
    </div>
</div>
    <?php endforeach; ?>
</body>
</html>