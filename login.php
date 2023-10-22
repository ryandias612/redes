<?php
$host = "localhost";
$banco = "redes";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        echo "Login bem-sucedido!"; // Redirecione o usuário para a página de boas-vindas ou outro destino.
    } else {
        echo "Credenciais inválidas. Tente novamente.";
    }
} catch(PDOException $e) {
    echo "Erro no login: " . $e->getMessage();
}
?>
