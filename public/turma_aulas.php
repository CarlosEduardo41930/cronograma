<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"/>
<title>EduPortal — Aulas da Turma</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen p-6">

<button onclick="history.back()"
        class="mb-6 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold">
  ← Voltar
</button>

<h1 class="text-3xl font-bold mb-6">Turma A – Matemática</h1>

<!-- Botão para criar nova aula -->
<div class="mb-6">
  <a href="cadastrar_aula.php" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-xl font-semibold text-white">
    Criar Nova Aula
  </a>
</div>

<div class="space-y-4">

  <!-- Aula 1 -->
  <div class="relative p-4 rounded-2xl border border-[#1F2C42] bg-[#161D2E]">
    <!-- Badge Status -->
    <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-xs font-semibold bg-green-600">
      Ativa
    </span>

    <h2 class="text-xl font-semibold mb-1">Aula 1 – Equações</h2>
    <p class="text-sm text-slate-400 mb-2">Resolver exercícios do capítulo 1</p>
    <p class="text-xs text-slate-500 mb-2">Data: 25/03/2026 | Tipo: Exercício</p>

    <div class="flex gap-2 mb-2">
      <span class="px-2 py-0.5 rounded text-xs" style="background-color: rgb(209,125,43);">Excel</span>
      <span class="px-2 py-0.5 rounded text-xs" style="background-color: rgb(209,125,43);">Word</span>
    </div>

    <div class="flex gap-2 justify-between">
      <div class="flex gap-2">
        <a href="#" class="px-3 py-1 bg-green-600 hover:bg-green-700 rounded text-sm">Exercício</a>
        <a href="#" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm">Slide</a>
        <a href="#" class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm">Correção</a>
      </div>
      <a href="editar_aula.php" class="px-3 py-1 bg-blue-300 hover:bg-blue-400 rounded text-sm text-black font-semibold">
        Editar Aula
      </a>
    </div>
  </div>

  <!-- Aula 2 -->
  <div class="relative p-4 rounded-2xl border border-[#1F2C42] bg-[#161D2E]">
    <!-- Badge Status -->
    <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-600">
      Inativa
    </span>

    <h2 class="text-xl font-semibold mb-1">Aula 2 – Geometria</h2>
    <p class="text-sm text-slate-400 mb-2">Atividades sobre triângulos</p>
    <p class="text-xs text-slate-500 mb-2">Data: 26/03/2026 | Tipo: Slide</p>

    <div class="flex gap-2 mb-2">
      <span class="px-2 py-0.5 rounded text-xs" style="background-color: rgb(209,125,43);">PowerPoint</span>
    </div>

    <div class="flex gap-2 justify-between">
      <div class="flex gap-2">
        <a href="#" class="px-3 py-1 bg-green-600 hover:bg-green-700 rounded text-sm">Exercício</a>
        <a href="#" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm">Slide</a>
        <a href="#" class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm">Correção</a>
      </div>
      <a href="editar_aula.php" class="px-3 py-1 bg-blue-300 hover:bg-blue-400 rounded text-sm text-black font-semibold">
        Editar Aula
      </a>
    </div>
  </div>

</div>

</body>
</html>