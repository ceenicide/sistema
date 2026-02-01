<?php
session_start();


require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/src/Avaliacao.php';
require_once dirname(__DIR__) . '/src/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    // Verifica se usuário existe e se a senha bate com o hash
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['nome_usuario'] = $user['usuario'];
        header('Location: dashboard.php');
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo</title>
    <style>
    body { background: #f1f5f9; font-family: 'Inter', sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
    .login-card { background: white; padding: 2.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 100%; max-width: 360px; }
    h2 { margin-top: 0; font-size: 1.25rem; color: #0f172a; text-align: center; }
    input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #e2e8f0; border-radius: 6px; box-sizing: border-box; }
    button { width: 100%; background: #0f172a; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: 600; cursor: pointer; margin-top: 10px; }
    .error-msg { background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 6px; font-size: 0.8rem; margin-bottom: 1rem; text-align: center; }
</style>
</head>
<body>
    <div class="login-box">
        <h2>logar administrador</h2>
        <?php if (isset($erro)): ?> <p class="erro"><?= $erro ?></p> <?php endif; ?>
        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>