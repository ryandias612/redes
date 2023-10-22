<!DOCTYPE html>
<html>
<head>
    <title>Redefinir Senha</title>
</head>
<body>
    <h1>Redefinir Senha</h1>
    <form action="processar_redefinicao.php" method="post">
        <label for="nova-senha">Nova Senha:</label>
        <input type="password" id="nova-senha" name="nova-senha" required><br><br>
        <label for="confirmar-senha">Confirmar Nova Senha:</label>
        <input type="password" id="confirmar-senha" name="confirmar-senha" required><br><br>
        <input type="submit" value="Redefinir Senha">
    </form>
</body>
</html>
