<?php
$host = "localhost";
$banco = "redes";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receba a nova senha e a confirmação da senha
    $novaSenha = $_POST['nova-senha'];
    $confirmarSenha = $_POST['confirmar-senha'];

    if ($novaSenha === $confirmarSenha) {
        // As senhas coincidem, atualize a senha no banco de dados
        $idUsuario = $_SESSION['id_usuario']; // Suponha que você tenha armazenado o ID do usuário na sessão durante a verificação de resposta de segurança.

        // Hash da nova senha
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualize a senha no banco de dados
        $stmt = $conexao->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->execute([$senhaHash, $idUsuario]);

        // Redirecione para a página de login
        header("Location: login.html");
        exit();
    } else {
        // As senhas não coincidem, mostre uma mensagem de erro
        echo "As senhas não coincidem. Tente novamente.";
    }
} catch (PDOException $e) {
    echo "Erro na atualização da senha: " . implode(" - ", $stmt->errorInfo());
}
?>
