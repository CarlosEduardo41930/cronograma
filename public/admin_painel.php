<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['administrador']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>EduPortal - Painel Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon"
        href="https://i.postimg.cc/MpRFphR6/Logo-digital-Edu-Portal-com-simbolos-educativos.png"
        type="image/x-icon">
</head>

<body class="bg-gray-900 text-white p-6 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-gray-800 p-6 rounded-lg shadow-lg">

        <!-- BOTÃO SAIR -->
        <div class="flex justify-end mb-6">
            <a href="../src/controllers/logout.php"
                class="px-4 mx-4 py-2 bg-red-500 hover:bg-red-600 rounded-xl font-semibold text-white">
                Sair
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center">Painel do Administrador</h1>

        <?php mensagemErro(); ?>
        <?php mensagemSucesso(); ?>

        <!-- BOTÕES -->
        <div class="flex flex-col gap-4 mb-6">
            <a href="create_professor.php"
                class="bg-blue-600 hover:bg-blue-700 p-3 rounded font-semibold transition text-center">
                Criar Professor
            </a>

            <a href="create_turma.php"
                class="bg-green-600 hover:bg-green-700 p-3 rounded font-semibold transition text-center">
                Criar Turma
            </a>
        </div>

        <!-- CARD PROFESSORES -->
        <div class="bg-gray-900 p-4 rounded-xl border border-gray-700 mb-4">
            <h2 class="text-lg font-semibold mb-3">Professores</h2>

            <div id="listaProfessores" class="space-y-2">

                <div class="flex justify-between items-center bg-gray-800 p-2 rounded">
                    <span>Professor João</span>
                    <button onclick="removerItem(this)"
                        class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                        Excluir
                    </button>
                </div>

                <div class="flex justify-between items-center bg-gray-800 p-2 rounded">
                    <span>Professora Maria</span>
                    <button onclick="removerItem(this)"
                        class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                        Excluir
                    </button>
                </div>

            </div>
        </div>

        <!-- CARD TURMAS -->
        <div class="bg-gray-900 p-4 rounded-xl border border-gray-700">
            <h2 class="text-lg font-semibold mb-3">Turmas</h2>

            <div id="listaTurmas" class="space-y-2">

                <div class="flex justify-between items-center bg-gray-800 p-2 rounded">
                    <span>Turma A</span>
                    <a href="excluir_admin.php"
                        class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                        Excluir
                    </a>
                </div>

                <div class="flex justify-between items-center bg-gray-800 p-2 rounded">
                    <span>Turma B</span>
                    <button onclick="removerItem(this)"
                        class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                        Excluir
                    </button>
                </div>

            </div>
        </div>

    </div>

</body>

</html>