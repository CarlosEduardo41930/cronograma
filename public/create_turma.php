<?php
session_start();
require 'conexao.php'; // cria $pdo

// Função para criar turma
function setCriarTurma($pdo, $turma, $descricao, $fk_professor_id) {
    if (!$turma || !$fk_professor_id) {
        $_SESSION['erro'][] = "Nome da turma e professor são obrigatórios.";
        return false;
    }

    if (!is_numeric($fk_professor_id)) {
        $_SESSION['erro'][] = "ID do professor inválido.";
        return false;
    }

    // Cria registro na tabela turma
    $sql = "INSERT INTO turma (turma, descricao, fk_professor) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$turma, $descricao, $fk_professor_id]);

    if (!$sucesso) {
        $_SESSION['erro'][] = "Erro ao criar a turma.";
        return false;
    }

    $_SESSION['sucesso'][] = "Turma criada com sucesso!";
    return true;
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setCriarTurma($pdo, $_POST['turma'], $_POST['descricao'], $_POST['fk_professor_id']);
}

// Lista professores para selecionar
$professores = $pdo->query("SELECT id, tipo, descricao FROM professor")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Turma</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg">
        <h1 class="text-xl font-bold mb-4">Criar Turma</h1>

        <?php
        if (!empty($_SESSION['erro'])) {
            foreach ($_SESSION['erro'] as $msg) {
                echo "<div class='bg-red-700 p-2 mb-2 rounded'>$msg</div>";
            }
            unset($_SESSION['erro']);
        }

        if (!empty($_SESSION['sucesso'])) {
            foreach ($_SESSION['sucesso'] as $msg) {
                echo "<div class='bg-green-700 p-2 mb-2 rounded'>$msg</div>";
            }
            unset($_SESSION['sucesso']);
        }
        ?>

        <form method="POST" class="flex flex-col gap-3">
            <input type="text" name="turma" placeholder="Nome da turma" class="p-2 rounded bg-gray-700">
            <input type="text" name="descricao" placeholder="Descrição da turma" class="p-2 rounded bg-gray-700">
            <select name="fk_professor_id" class="p-2 rounded bg-gray-700">
                <option value="">Selecione um professor</option>
                <?php foreach ($professores as $prof): ?>
                    <option value="<?= $prof['id'] ?>"><?= htmlspecialchars($prof['tipo'] . ' - ' . $prof['descricao']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 p-2 rounded mt-2">Criar Turma</button>
        </form>
    </div>
</body>
</html>