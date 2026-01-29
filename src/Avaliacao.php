<?php
class Avaliacao {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function salvar($comida, $atendimento, $geral, $comentario) {
        $sql = "INSERT INTO avaliacoes (nota_comida, nota_atendimento, nota_geral, comentario) 
                VALUES (:c, :a, :g, :coment)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':c' => $comida,
            ':a' => $atendimento,
            ':g' => $geral,
            ':coment' => $comentario
        ]);
    }

    public function listarTodas() {
        return $this->pdo->query("SELECT * FROM avaliacoes ORDER BY data_avaliacao DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id) {
        return $this->pdo->prepare("DELETE FROM avaliacoes WHERE id = ?")->execute([$id]);
    }
}