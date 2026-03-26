<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>EduPortal — Editar Aula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen p-6 flex justify-center">

    <div class="w-full max-w-xl p-8 rounded-2xl bg-[#161D2E] border border-[#1F2C42]">
        <button onclick="history.back()"
            class="mb-6 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold">
            ← Voltar
        </button>
        <h1 class="text-3xl font-bold mb-6">Editar Aula</h1>

        <form class="space-y-4">

            <!-- Título -->
            <div>
                <label class="block text-sm mb-1">Título</label>
                <input type="text" value="Título Atual da Aula" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Descrição -->
            <div>
                <label class="block text-sm mb-1">Descrição</label>
                <textarea class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" rows="3">Descrição atual da aula</textarea>
            </div>

            <!-- Data -->
            <div>
                <label class="block text-sm mb-1">Data</label>
                <input type="date" value="2026-03-25" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Tipo -->
            <div>
                <label class="block text-sm mb-1">Tipo</label>
                <select class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option selected>Exercício</option>
                    <option>Slide</option>
                    <option>Correção</option>
                    <option>Outro</option>
                </select>
            </div>

            <!-- Ordem -->
            <div>
                <label class="block text-sm mb-1">Ordem</label>
                <input type="number" value="1" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option selected>Ativa</option>
                    <option>Inativa</option>
                </select>
            </div>

            <!-- Exercício -->
            <div>
                <label class="block text-sm mb-1">Exercício (link)</label>
                <input type="url" value="https://exemplo.com/exercicio" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Slide -->
            <div>
                <label class="block text-sm mb-1">Slide (link)</label>
                <input type="url" value="https://exemplo.com/slide" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Correção -->
            <div>
                <label class="block text-sm mb-1">Correção (link)</label>
                <input type="url" value="https://exemplo.com/correcao" class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]" />
            </div>

            <!-- Turma -->
            <div>
                <label class="block text-sm mb-1">Turma</label>
                <select class="w-full p-3 rounded bg-[#111827] border border-[#1F2C42]">
                    <option selected>Turma A – Matemática</option>
                    <option>Turma B – História</option>
                </select>
            </div>

            <!-- Botão -->
            <button type="submit" class="w-full py-3 rounded bg-yellow-500 hover:bg-yellow-600 font-semibold text-white">
                Salvar Alterações
            </button>

        </form>

    </div>
</body>

</html>