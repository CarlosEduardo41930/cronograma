<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['professor']);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <title>EduPortal — Aulas da Turma</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen p-6 flex flex-col">

  <div class="flex items-center gap-4 mb-6">

    <!-- Botão Voltar -->
    <button onclick="history.back()"
      class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold transition-colors duration-200">
      ← Voltar
    </button>

    <!-- Botão Sair -->
    <a href="../src/controllers/logout.php"
      class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-sm font-semibold text-white transition-colors duration-200">
      Sair
    </a>
  </div>
  

  <h1 class="text-3xl font-bold mb-6">Turma A – Matemática</h1>

  <!-- Botão para criar nova aula -->
  <div class="mb-6">
    <a href="cadastrar_aula.php?turma=<?= trim($_GET['turma']) ?>" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-xl font-semibold text-white">
      Criar Nova Aula
    </a>
  </div>

  <div class="space-y-4 mb-4">

    <?php aulaProfessor(); ?>

  </div>

  <footer class="bg-blue-900 text-gray-200 mt-auto py-6">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-6">

      <!-- Identidade -->
      <div>
        <h2 class="text-lg font-bold text-white mb-1">Inclusão Digital</h2>
        <p class="text-sm leading-snug">
          Acesso à tecnologia e educação digital, criando oportunidades e reduzindo desigualdades.
        </p>
      </div>

      <!-- Contato + Acessibilidade -->
      <div>
        <h3 class="text-xl font-semibold text-white mb-1">Contato</h3>
        <p class="text-sm">Email: edudigital08@fiec.com.br</p>
        <p class="text-sm">Telefone: (19) 99300-8684</p>
        <p class="text-sm mb-2">Atendimento: Seg–Sex, 8h às 12h</p>

        <h4 class="text-[0.95rem] font-semibold text-white mb-1">Acessibilidade</h4>
        <p class="text-[0.85rem] text-gray-300 leading-snug">
          Este site segue boas práticas de acessibilidade, garantindo uma experiência inclusiva.
        </p>
      </div>

    </div>

    <!-- Linha inferior -->
    <div class="mt-6 border-t border-blue-800 pt-3 text-center text-sm text-gray-400">
      © 2026 Inclusão Digital • Compromisso com educação e inclusão
    </div>
  </footer>

</body>

</html>