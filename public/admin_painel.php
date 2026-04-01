<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['administrador']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Painel Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-6 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-gray-800 p-6 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-6">Painel do Administrador</h1>
        <div class="flex justify-end mb-6">
            <a href="../src/controllers/logout.php"
                class="px-4 mx-4 py-2 bg-red-500 hover:bg-red-600 rounded-xl font-semibold text-white">
                Sair
            </a>
        </div>

        <?php mensagemErro(); ?>
        <?php mensagemSucesso(); ?>

        <div class="flex flex-col gap-4">
            <a href="create_professor.php"
                class="bg-blue-600 hover:bg-blue-700 p-3 rounded font-semibold transition">
                Criar Professor
            </a>

            <a href="create_turma.php"
                class="bg-green-600 hover:bg-green-700 p-3 rounded font-semibold transition">
                Criar Turma
            </a>
        </div>
    </div>

</body>

</html>