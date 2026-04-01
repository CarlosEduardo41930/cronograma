<?php
require_once '../src/controllers/UserControll.php';
editar();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>EduPortal — Editar Aula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen p-6 flex justify-center">

    <div class="w-full max-w-xl p-8 rounded-2xl bg-[#161D2E] border border-[#1F2C42]">
        <a href="turma_aulas.php?turma=<?=$turma?>" onclick="history.back()"
            class="mb-6 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold">
            ← Voltar
</a>
        <h1 class="text-3xl font-bold mb-6">Editar Aula</h1>

        <form method="POST" class="space-y-4">
            <?php mensagemErro(); ?>
            <?php mostrarAula(); ?>

            <!-- Botão -->
             <?php mensagemSucesso(); ?>
            <button type="submit" class="w-full py-3 rounded bg-yellow-500 hover:bg-yellow-600 font-semibold text-white">
                Salvar Alterações
            </button>

        </form>

    </div>
</body>

</html>