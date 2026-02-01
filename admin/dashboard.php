<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) { header('Location: login.php'); exit; }

require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/src/Avaliacao.php';

$obj = new Avaliacao($pdo);
$avaliacoes = $obj->listarTodas();

// Lógica de estatísticas
$stats = $pdo->query("SELECT 
    AVG(nota_comida) as c, AVG(nota_atendimento) as a, AVG(nota_geral) as g, COUNT(*) as total 
    FROM avaliacoes")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Feedback Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #f8fafc; --card: #ffffff; --text-main: #1e293b; --text-sub: #64748b; --primary: #3b82f6; --danger: #ef4444; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg); color: var(--text-main); margin: 0; padding: 0; }
        
        /* Navbar */
        nav { background: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; }
        .logo { font-weight: 600; font-size: 1.2rem; color: var(--primary); }
        .logout { color: var(--text-sub); text-decoration: none; font-size: 0.9rem; border: 1px solid #e2e8f0; padding: 5px 12px; border-radius: 6px; }

        .container { max-width: 1100px; margin: 2rem auto; padding: 0 1rem; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: var(--card); padding: 1.5rem; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; }
        .stat-card span { color: var(--text-sub); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .stat-card h2 { margin: 0.5rem 0 0; font-size: 1.8rem; }

        /* List */
        .feedback-list { background: var(--card); border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background: #f1f5f9; padding: 1rem; font-size: 0.85rem; color: var(--text-sub); }
        td { padding: 1rem; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; }
        .stars { color: #f59e0b; font-weight: bold; }
        .comment { color: var(--text-sub); font-style: italic; max-width: 300px; }
        .btn-del { color: var(--danger); text-decoration: none; font-size: 0.8rem; padding: 5px 10px; border-radius: 4px; }
        .btn-del:hover { background: #fee2e2; }
    </style>
</head>
<body>

<nav>
    <div class="logo">🍽️ Restaurante Admin</div>
    <a href="logout.php" class="logout">Sair do Painel</a>
</nav>

<div class="container">
    <div class="stats-grid">
        <div class="stat-card">
            <span>Total Avaliações</span>
            <h2><?= $stats['total'] ?></h2>
        </div>
        <div class="stat-card">
            <span>Média Comida</span>
            <h2 class="stars"><?= number_format($stats['c'], 1) ?> <small style="font-size: 12px">★</small></h2>
        </div>
        <div class="stat-card">
            <span>Média Atendimento</span>
            <h2 class="stars"><?= number_format($stats['a'], 1) ?> <small style="font-size: 12px">★</small></h2>
        </div>
        <div class="stat-card">
            <span>Média Geral</span>
            <h2 class="stars"><?= number_format($stats['g'], 1) ?> <small style="font-size: 12px">★</small></h2>
        </div>
    </div>

    <div class="feedback-list">
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Notas (C / A / G)</th>
                    <th>Comentário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avaliacoes as $av): ?>
                <tr>
                    <td><?= date('d/m/y H:i', strtotime($av['data_avaliacao'])) ?></td>
                    <td>
                        <span class="stars"><?= $av['nota_comida'] ?></span> / 
                        <span class="stars"><?= $av['nota_atendimento'] ?></span> / 
                        <span class="stars"><?= $av['nota_geral'] ?></span>
                    </td>
                    <td class="comment">"<?= htmlspecialchars($av['comentario']) ?: 'Sem comentário.' ?>"</td>
                    <td>
                        <a href="excluir.php?id=<?= $av['id'] ?>" class="btn-del" onclick="return confirm('Excluir avaliação?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>