<?php
$host = "localhost";
$banco = "redes";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receba o e-mail fornecido pelo usuário
    $email = $_POST['email'];

    // Verifique se o e-mail está registrado no banco de dados
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // E-mail encontrado, redirecione para a página de seleção de pergunta de segurança
        header("Location: selecionar_pergunta.php");
        exit();
    } else {
        // E-mail não encontrado, mostre uma mensagem de erro
        echo "E-mail não encontrado. Verifique o e-mail e tente novamente.";
    }
} catch (PDOException $e) {
    echo "Erro na verificação de e-mail: " . $e->getMessage();
}
?>
