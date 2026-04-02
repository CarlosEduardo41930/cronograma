<?php
require_once '../src/controllers/UserControll.php';
novaAula();
verificarTipo(['administrador']);
$turma = $_GET['turma'];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>EduPortal — Cadastrar Aula</title>
    <script src="https://cdn.tailwindcss.com"></script>
      <link rel="shortcut icon" href="https://i.postimg.cc/MpRFphR6/Logo-digital-Edu-Portal-com-simbolos-educativos.png" type="image/x-icon">
</head>

<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen p-6 flex justify-center">

    <div class="w-full max-w-xl p-8 rounded-2xl bg-[#161D2E] border border-[#1F2C42]">
        <a href="turma_aulas.php?turma=<?=$turma?>"
            class="mb-6 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold">
            ← Voltar
        </a>
        <h1 class="text-3xl font-bold mb-6">Cadastrar Nova Aula</h1>
        <?php mensagemErro(); ?>
        <?php mensagemSucesso(); ?>

       <form method="POST" class="space-y-4">

            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm mb-1">Título:</label>
                <input name="titulo" type="text" required class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="Título da aula" />
            </div>

            <!-- Descrição -->
            <div>
                <label for="descricao" class="block text-sm mb-1">Descrição:</label>
                <textarea name="descricao" required class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" rows="3" placeholder="Descrição da aula"></textarea>
            </div>
            <!-- Data -->
            <div>
                <label for="data" class="block text-sm mb-1">Data:</label>
                <input name="data" type="date" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Tipo -->
            <div>
                <label for="tipo" class="block text-sm mb-1">Tipo:</label>
                <input name="tipo" type="text" required class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="Exel">
            </div>

            <!-- Ordem -->
            <div>
                <label for="ordem" class="block text-sm mb-1">Ordem:</label>
                <input name="ordem" type="number" step="0.1" required class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="1.0" />
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm mb-1">Status da Aula:</label>
                <select name="status" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option value="ativa">Ativa</option>
                    <option value="inativa">Inativa</option>
                </select>
            </div>

            <!-- Exercício -->
            <div>
                <label for="exercicio" class="block text-sm mb-1">Exercício (link):</label>
                <input name="exercicio" type="url" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="https://" />
            </div>

            <div>
                <label for="liberarExe" class="block text-sm mb-1">Mostrar Exercício:</label>
                <select name="liberarExe" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option value="" >...</option>
                    <option value="sim" class="text-green-700 bg-green-200">Vai Mostrar</option>
                    <option value="nao"class="text-red-700 bg-red-200">Não Vai Mostrar</option>
                </select>
            </div>

            <!-- Slide -->
            <div>
                <label for="slide" class="block text-sm mb-1">Slide (link):</label>
                <input name="slide" type="url" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="https://" />
            </div>
            <div>
                <label for="liberarSli" class="block text-sm mb-1">Mostrar Slide:</label>
                <select name="liberarSli" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option value="" >...</option>
                    <option value="sim" class="text-green-700 bg-green-200">Vai Mostrar</option>
                    <option value="nao"class="text-red-700 bg-red-200">Não Vai Mostrar</option>
                </select>
            </div>

            <!-- Correção -->
            <div>
                <label for="correcao" class="block text-sm mb-1">Correção (link):</label>
                <input name="correcao" type="url" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="https://" />
            </div>
            <div>
                <label for="liberarCorr" class="block text-sm mb-1">Mostrar Correção:</label>
                <select name="liberarCorr" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option value="" >...</option>
                    <option value="sim" class="text-green-700 bg-green-200">Vai Mostrar</option>
                    <option value="nao"class="text-red-700 bg-red-200">Não Vai Mostrar</option>
                </select>
            </div>








            <!-- Botão -->
            <button type="submit" class="w-full py-3 rounded bg-blue-500 hover:bg-blue-600 font-semibold text-white">
                Cadastrar Aula
            </button>




        </form>


    </div>
</body>

</html>