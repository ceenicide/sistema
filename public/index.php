<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avalie nossa Experiência</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #6366f1; --bg: #f8fafc; --text: #1e293b; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); display: flex; justify-content: center; padding: 20px; }
        .card { background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 100%; max-width: 450px; }
        h1 { font-size: 1.5rem; text-align: center; margin-bottom: 2rem; }
        .rating-group { margin-bottom: 1.5rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem; }
        .stars { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 5px; }
        .stars { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 5px; }
        .stars input { display: none; }
        .stars label { font-size: 1.5rem; color: #cbd5e1; cursor: pointer; transition: color 0.2s; }
        .stars input:checked ~ label, .stars label:hover, .stars label:hover ~ label { color: #f59e0b; }
        textarea { width: 100%; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; font-family: inherit; resize: none; box-sizing: border-box; }
        button { width: 100%; background: var(--primary); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer; margin-top: 1rem; transition: opacity 0.2s; }
        button:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Como voce avalia nossos Servicos ?</h1>
        <form action="salvar.php" method="POST">
            <?php
            $campos = [
                'nota_comida' => 'A comida estava boa?',
                'nota_atendimento' => 'O atendimento foi satisfatório?',
                'nota_geral' => 'Sua nota geral para nós'
            ];
            foreach ($campos as $name => $label): ?>
                <div class="rating-group">
                    <label><?php echo $label; ?></label>
                    <div class="stars">
                        <?php for($i=5; $i>=1; $i--): ?>
                            <input type="radio" id="<?php echo $name.$i; ?>" name="<?php echo $name; ?>" value="<?php echo $i; ?>" required>
                            <label for="<?php echo $name.$i; ?>">★</label>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <label>Comentários (Opcional) </label>
            <textarea name="comentario" rows="3" placeholder="Opcional..."></textarea>
            <button type="submit">Enviar Avaliação</button>
        </form>
    </div>
</body>
</html>