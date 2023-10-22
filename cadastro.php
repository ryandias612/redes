<?php
$host = "localhost";
$banco = "redes";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $dataNascimento = $_POST['data-nascimento'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
    $perguntaSegurancaID = $_POST['pergunta-seguranca'];
$respostaSeguranca = $_POST['resposta-seguranca'];

// Inserir os dados do usuário, incluindo a pergunta de segurança e resposta, na tabela 'usuarios'
$stmt = $conexao->prepare("INSERT INTO usuarios (nome, usuario, email, data_nascimento, senha, pergunta_seguranca_id, resposta_pergunta_seguranca) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$nome, $usuario, $email, $dataNascimento, $senha, $perguntaSegurancaID, $respostaSeguranca]);

    echo "Cadastro realizado com sucesso!";
} catch(PDOException $e) {
    echo "Erro no cadastro: " . $e->getMessage();
}
?>
