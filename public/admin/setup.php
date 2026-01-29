<?php
require_once dirname(dirname(__DIR__)) . '/config/database.php';

try {
    // 1. Garante que a coluna de senha suporte o hash (mínimo 60, recomendado 255)
    $pdo->exec("ALTER TABLE usuarios MODIFY COLUMN senha VARCHAR(255) NOT NULL");

    // 2. Limpa a tabela para evitar conflitos
    $pdo->exec("DELETE FROM usuarios");

    // 3. Define os novos dados
    $novoUsuario = 'admin';
    $novaSenha = '123'; // Pode mudar para o que quiser
    $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

    // 4. Insere o novo usuário
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    $stmt->execute([$novoUsuario, $hash]);

    echo "✅ Usuário '$novoUsuario' criado com sucesso!<br>";
    echo "🔑 Senha definida: $novaSenha<br><br>";
    echo "<a href='login.php'>Ir para o Login</a>";

} catch (PDOException $e) {
    die("❌ Erro ao configurar usuário: " . $e->getMessage());
}