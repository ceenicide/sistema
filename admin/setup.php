<?php
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/src/Avaliacao.php';
require_once dirname(__DIR__) . '/src/Usuario.php';

try {
    $pdo->exec("ALTER TABLE usuarios MODIFY COLUMN senha VARCHAR(255) NOT NULL");

  
    $pdo->exec("DELETE FROM usuarios");

   
    $novoUsuario = 'admin';
    $novaSenha = '123'; // Pode mudar para o que quiser
    $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    $stmt->execute([$novoUsuario, $hash]);

    echo " Usuário '$novoUsuario' criado com sucesso!<br>";
    echo " Senha definida: $novaSenha<br><br>";
    echo "<a href='login.php'>Ir para o Login</a>";

} catch (PDOException $e) {
    die(" Erro ao configurar usuário: " . $e->getMessage());
}