<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>EduPortal — Confirmar Exclusão</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md p-8 rounded-2xl bg-[#161D2E] border border-[#1F2C42] shadow-lg">

        <!-- Voltar -->
        <button onclick="history.back()"
            class="mb-6 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold transition">
            ← Voltar
        </button>

        <!-- Ícone -->
        <div class="flex justify-center mb-4 text-red-400 text-4xl">
            ⚠️
        </div>

        <!-- Título -->
        <h1 class="text-2xl font-bold text-center mb-3">
            Confirmar Exclusão
        </h1>

        <!-- Texto -->
        <p class="text-sm text-slate-400 text-center mb-6">
            Tem certeza que deseja excluir esta aula?<br>
            <span class="text-red-400 font-semibold">Essa ação não pode ser desfeita.</span>
        </p>



        <!-- Botões -->
        <form method="POST" class="flex gap-3">

            <!-- Cancelar -->
            <button type="button" onclick="history.back()"
                class="w-full py-3 rounded-lg bg-gray-600 hover:bg-gray-700 text-sm font-semibold transition">
                Cancelar
            </button>

            <!-- Confirmar -->
            <button type="submit"
                class="w-full py-3 rounded-lg bg-red-500 hover:bg-red-600 text-sm font-semibold text-white transition">
                🗑️ Excluir
            </button>

        </form>

    </div>

</body>
</html>