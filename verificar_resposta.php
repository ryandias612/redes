<?php
$host = "localhost";
$banco = "redes";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receba a pergunta de segurança selecionada e a resposta fornecida pelo usuário
    $perguntaSeguranca = $_POST['pergunta-seguranca'];
    $resposta = $_POST['resposta'];

    // Verifique se a resposta corresponde à resposta no banco de dados
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE pergunta_seguranca_id = ? AND resposta_pergunta_seguranca = ?");
    $stmt->execute([$perguntaSeguranca, $resposta]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Resposta correta, redirecione para a página de redefinição de senha
        header("Location: redefinir_senha.php");
        exit();
    } else {
        // Resposta incorreta, mostre uma mensagem de erro
        echo "Resposta de segurança incorreta. Verifique e tente novamente.";
    }
} catch (PDOException $e) {
    echo "Erro na verificação de resposta de segurança: " . $e->getMessage();
}
?>
