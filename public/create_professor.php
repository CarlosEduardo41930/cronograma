<?php
session_start();


//Função para criar professor
function setCriarProfessor($pdo, $nome, $senha, $tipo, $descricao, $nivel = 'professor') {
    if (!$nome || !$senha || !$tipo) {
        $_SESSION['erro'][] = "Todos os campos obrigatórios devem ser preenchidos.";
        return false;
    }

    // Criptografa a senha
    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Cria usuário na tabela usuario
    $sqlUser = "INSERT INTO usuario (nome, senha, nivel) VALUES (?, ?, ?)";
    $stmtUser = $pdo->prepare($sqlUser);
    $sucessoUser = $stmtUser->execute([$nome, $hashSenha, $nivel]);

    if (!$sucessoUser) {
        $_SESSION['erro'][] = "Erro ao criar usuário do professor.";
        return false;
    }

    $idUsuario = $pdo->lastInsertId();

    // Cria registro na tabela professor
    $sqlProf = "INSERT INTO professor (tipo, descricao, fk_usuario_id) VALUES (?, ?, ?)";
    $stmtProf = $pdo->prepare($sqlProf);
    $sucessoProf = $stmtProf->execute([$tipo, $descricao, $idUsuario]);

    if (!$sucessoProf) {
        $_SESSION['erro'][] = "Erro ao criar registro do professor.";
        return false;
    }

    $_SESSION['sucesso'][] = "Professor criado com sucesso!";
    return true;
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setCriarProfessor($pdo, $_POST['nome'], $_POST['senha'], $_POST['tipo'], $_POST['descricao']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Professor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg">
        <h1 class="text-xl font-bold mb-4">Criar Professor</h1>

        <?php mensagemErro(); ?>
        <?php mensagemSucesso(); ?>

        <form method="POST" class="flex flex-col gap-3">
            <input type="text" name="nome" placeholder="Nome do professor" class="p-2 rounded bg-gray-700">
            <input type="password" name="senha" placeholder="Senha" class="p-2 rounded bg-gray-700">
            <input type="text" name="tipo" placeholder="Tipo de professor" class="p-2 rounded bg-gray-700">
            <input type="text" name="descricao" placeholder="Descrição" class="p-2 rounded bg-gray-700">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 p-2 rounded mt-2">Criar</button>
        </form>
    </div>
</body>
</html>