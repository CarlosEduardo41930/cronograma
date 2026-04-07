<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['administrador']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>EduPortal — Painel Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="shortcut icon" href="https://i.postimg.cc/MpRFphR6/Logo-digital-Edu-Portal-com-simbolos-educativos.png" type="image/x-icon">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .bg-glow {
      position: fixed; top: 30%; left: 50%;
      transform: translate(-50%, -50%);
      width: 700px; height: 700px; border-radius: 50%;
      background: radial-gradient(circle, rgba(59,130,246,0.07) 0%, transparent 70%);
      pointer-events: none; z-index: 0;
    }
    .item-card { transition: background 0.15s; }
    .item-card:hover { background: #1F2C42 !important; }
    .btn-shine { position: relative; overflow: hidden; }
    .btn-shine::after {
      content: ''; position: absolute; top: 0; left: -100%;
      width: 60%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
      transform: skewX(-20deg); transition: left 0.5s ease;
    }
    .btn-shine:hover::after { left: 160%; }
  </style>
</head>
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen">

  <div class="bg-glow"></div>
  <div class="fixed top-0 right-0 w-72 h-72 opacity-[0.05] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #3B82F6 1px, transparent 1px); background-size: 22px 22px;"></div>

  <!-- NAVBAR -->
  <nav class="relative z-10 border-b border-[#1F2C42] bg-[#0B0F1A]/80 backdrop-blur-sm sticky top-0">
    <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/25 flex items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <div>
          <span class="text-lg font-bold" style="font-family:'Syne',sans-serif;">EduPortal</span>
          <span class="ml-2 text-xs text-[#8DA4BF] hidden sm:inline">/ Administrador</span>
        </div>
      </div>
      <a href="../src/controllers/logout.php"
         class="text-sm font-semibold px-4 py-2 rounded-lg border border-red-500/30 text-red-400 hover:bg-red-500/10 transition-all duration-200"
         style="font-family:'Syne',sans-serif;">
        Sair
      </a>
    </div>
  </nav>

  <div class="relative z-10 max-w-5xl mx-auto px-6 pt-10 pb-16">

    <div class="mb-8">
      <p class="text-xs uppercase tracking-widest text-[#8DA4BF] mb-1">Administração</p>
      <h1 class="text-3xl font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Painel do Administrador</h1>
    </div>

    <?php mensagemErro(); ?>
    <?php mensagemSucesso(); ?>

    <!-- Ações rápidas -->
    <div class="grid sm:grid-cols-2 gap-4 mb-10">
      <a href="create_professor.php"
         class="btn-shine bg-[#111827] border border-[#1F2C42] hover:border-blue-500/30 rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 group">
        <div class="w-11 h-11 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
        </div>
        <div>
          <p class="font-bold text-[#E8EFF7] group-hover:text-blue-400 transition-colors" style="font-family:'Syne',sans-serif;">Criar Professor</p>
          <p class="text-xs text-[#8DA4BF] mt-0.5">Adicionar novo professor ao sistema</p>
        </div>
      </a>

      <a href="create_turma.php"
         class="btn-shine bg-[#111827] border border-[#1F2C42] hover:border-green-500/30 rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 group">
        <div class="w-11 h-11 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="#4ADE80" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <div>
          <p class="font-bold text-[#E8EFF7] group-hover:text-green-400 transition-colors" style="font-family:'Syne',sans-serif;">Criar Turma</p>
          <p class="text-xs text-[#8DA4BF] mt-0.5">Adicionar nova turma ao sistema</p>
        </div>
      </a>
    </div>

    <!-- Listas -->
    <div class="grid sm:grid-cols-2 gap-6">

      <!-- Professores -->
      <div class="bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="flex items-center gap-2 mb-5">
          <div class="w-7 h-7 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
            <svg class="w-3.5 h-3.5" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <h2 class="font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Professores</h2>
        </div>
        <div class="space-y-2">
          <?php professorAdmin(); ?>
        </div>
      </div>

      <!-- Turmas -->
      <div class="bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="flex items-center gap-2 mb-5">
          <div class="w-7 h-7 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center">
            <svg class="w-3.5 h-3.5" fill="none" stroke="#4ADE80" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
          <h2 class="font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Turmas</h2>
        </div>
        <div class="space-y-2">
          <?php turmasAdmin(); ?>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
