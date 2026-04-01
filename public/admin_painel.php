<?php
session_start();
require 'conexao.php'; // conexão com PDO
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