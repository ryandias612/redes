<?php
$host = "localhost";
$banco = "redes";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obter todas as perguntas de segurança do banco de dados
    $stmt = $conexao->query("SELECT id, pergunta FROM perguntas_seguranca");

    // Obtenha todas as perguntas de segurança como um array associativo
    $perguntasSeguranca = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na recuperação das perguntas de segurança: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Selecionar Pergunta de Segurança</title>
</head>
<body>
    <h1>Selecionar Pergunta de Segurança</h1>
    <form action="verificar_resposta.php" method="post">
        <label for="pergunta-seguranca">Selecione sua Pergunta de Segurança:</label>
        <select id="pergunta-seguranca" name="pergunta-seguranca" required>
            <?php foreach ($perguntasSeguranca as $pergunta) : ?>
                <option value="<?php echo $pergunta['id']; ?>"><?php echo $pergunta['pergunta']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="resposta">Resposta:</label>
        <input type="text" id="resposta" name="resposta" required><br><br>
        <input type="submit" value="Continuar">
    </form>
</body>
</html>
