<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>403 — Acesso Negado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-lg p-8 rounded-2xl bg-[#161D2E] border border-[#1F2C42] shadow-lg text-center">

        <!-- Código -->
        <h1 class="text-6xl font-bold text-red-500 mb-2">403</h1>

        <!-- Ícone -->
        <div class="text-5xl mb-4">🚫</div>

        <!-- Título -->
        <h2 class="text-2xl font-semibold mb-3">
            Acesso Negado
        </h2>

        <!-- Descrição -->
        <p class="text-sm text-slate-400 mb-6">
            Você não tem permissão para acessar esta página.<br>
            Se acredita que isso é um erro, entre em contato com o administrador.
        </p>

        <!-- Botões -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">

            <!-- Voltar -->
            <button onclick="history.back()"
                class="px-4 py-2 rounded-lg bg-gray-600 hover:bg-gray-700 text-sm font-semibold transition">
                ← Voltar
            </button>

            <!-- Home -->
            <a href="login.php"
                class="px-4 py-2 rounded-lg bg-blue-500 hover:bg-blue-600 text-sm font-semibold text-white transition">
                🏠 Ir para início
            </a>

        </div>

    </div>

</body>
</html>