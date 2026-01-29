<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Avalie sua Experiência</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 40px auto; padding: 20px; line-height: 1.6; }
        .bloco { margin-bottom: 20px; padding: 15px; border-bottom: 1px solid #eee; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        select { width: 100%; padding: 8px; border-radius: 4px; }
        textarea { width: 100%; height: 80px; margin-top: 10px; }
        button { background: #28a745; color: white; border: none; padding: 12px 20px; width: 100%; cursor: pointer; font-size: 16px; border-radius: 5px; }
    </style>
</head>
<body>
    <form action="salvar.php" method="POST">
        <h2>Sua opinião é importante!</h2>
        
        <div class="bloco">
            <label>Qualidade da Comida:</label>
            <select name="nota_comida" required>
                <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                <option value="4">⭐⭐⭐⭐ (Boa)</option>
                <option value="3">⭐⭐⭐ (Regular)</option>
                <option value="2">⭐⭐ (Ruim)</option>
                <option value="1">⭐ (Péssima)</option>
            </select>
        </div>

        <div class="bloco">
            <label>Atendimento:</label>
            <select name="nota_atendimento" required>
                <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                <option value="4">⭐⭐⭐⭐ (Bom)</option>
                <option value="3">⭐⭐⭐ (Regular)</option>
                <option value="2">⭐⭐ (Ruim)</option>
                <option value="1">⭐ (Péssimo)</option>
            </select>
        </div>

        <div class="bloco">
            <label>Nota Geral da Experiência:</label>
            <select name="nota_geral" required>
                <option value="5">⭐⭐⭐⭐⭐ (Incrível)</option>
                <option value="4">⭐⭐⭐⭐ (Muito Bom)</option>
                <option value="3">⭐⭐⭐ (Satisfeito)</option>
                <option value="2">⭐⭐ (Poderia ser melhor)</option>
                <option value="1">⭐ (Não volto)</option>
            </select>
        </div>

        <div class="bloco">
            <label>Algum comentário?</label>
            <textarea name="comentario" placeholder="Conte-nos mais sobre sua visita..."></textarea>
        </div>

        <button type="submit">Enviar Avaliação</button>
    </form>
</body>
</html>