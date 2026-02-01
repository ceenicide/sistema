<?php
class Usuario {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function login($usuario, $senha) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :u");
        $stmt->execute([':u' => $usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            return $user;
        }
        return false;
    }
}