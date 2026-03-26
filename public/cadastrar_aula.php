<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>EduPortal — Cadastrar Aula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen p-6 flex justify-center">

    <div class="w-full max-w-xl p-8 rounded-2xl bg-[#161D2E] border border-[#1F2C42]">
        <button onclick="history.back()"
            class="mb-6 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold">
            ← Voltar
        </button>
        <h1 class="text-3xl font-bold mb-6">Cadastrar Nova Aula</h1>

        <form class="space-y-4">

            <!-- Título -->
            <div>
                <label class="block text-sm mb-1">Título</label>
                <input type="text" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="Título da aula" />
            </div>

            <!-- Descrição -->
            <div>
                <label class="block text-sm mb-1">Descrição</label>
                <textarea class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" rows="3" placeholder="Descrição da aula"></textarea>
            </div>

            <!-- Data -->
            <div>
                <label class="block text-sm mb-1">Data</label>
                <input type="date" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Tipo -->
            <div>
                <label class="block text-sm mb-1">Tipo</label>
                <select class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option>Exercício</option>
                    <option>Slide</option>
                    <option>Correção</option>
                    <option>Outro</option>
                </select>
            </div>

            <!-- Ordem -->
            <div>
                <label class="block text-sm mb-1">Ordem</label>
                <input type="number" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="1" />
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option>Ativa</option>
                    <option>Inativa</option>
                </select>
            </div>

            <!-- Exercício -->
            <div>
                <label class="block text-sm mb-1">Exercício (link)</label>
                <input type="url" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="https://" />
            </div>

            <!-- Slide -->
            <div>
                <label class="block text-sm mb-1">Slide (link)</label>
                <input type="url" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="https://" />
            </div>

            <!-- Correção -->
            <div>
                <label class="block text-sm mb-1">Correção (link)</label>
                <input type="url" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" placeholder="https://" />
            </div>

            <!-- Turma -->
            <div>
                <label class="block text-sm mb-1">Turma</label>
                <select class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option>Turma A – Matemática</option>
                    <option>Turma B – História</option>
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