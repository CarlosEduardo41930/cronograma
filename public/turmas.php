<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['professor']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <title>EduPortal — Minhas Turmas</title>
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
    .turma-card { transition: border-color 0.2s, transform 0.2s, background 0.2s; }
    .turma-card:hover { border-color: rgba(59,130,246,0.4) !important; transform: translateY(-3px); background: #161D2E !important; }
    .nav-link { transition: color 0.2s; }
    .nav-link:hover { color: #60A5FA; }
  </style>
</head>
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen flex flex-col">

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
        <span class="text-lg font-bold" style="font-family:'Syne',sans-serif;">EduPortal</span>
      </div>
      <div class="flex items-center gap-3">
        <a href="https://classroom.google.com/" target="_blank"
           class="hidden sm:inline-flex items-center gap-1.5 text-sm text-[#8DA4BF] nav-link">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
          </svg>
          Google Sala de Aula
        </a>
        <a href="../src/controllers/logout.php"
           class="text-sm font-semibold px-4 py-2 rounded-lg border border-red-500/30 text-red-400 hover:bg-red-500/10 transition-all duration-200"
           style="font-family:'Syne',sans-serif;">
          Sair
        </a>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <main class="relative z-10 max-w-5xl mx-auto px-6 pt-10 pb-16 w-full flex-1">

    <div class="mb-8">
      <p class="text-xs uppercase tracking-widest text-[#8DA4BF] mb-1">Área do professor</p>
      <h1 class="text-3xl font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Minhas Turmas</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <?php turmas(); ?>
    </div>

  </main>

  <!-- FOOTER -->
  <footer class="relative z-10 border-t border-[#1F2C42] py-8 mt-auto">
    <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <h2 class="text-sm font-bold text-[#E8EFF7] mb-1" style="font-family:'Syne',sans-serif;">Inclusão Digital</h2>
        <p class="text-xs text-[#8DA4BF] leading-relaxed">Acesso à tecnologia e educação digital, criando oportunidades e reduzindo desigualdades.</p>
      </div>
      <div>
        <h3 class="text-sm font-bold text-[#E8EFF7] mb-1" style="font-family:'Syne',sans-serif;">Contato</h3>
        <p class="text-xs text-[#8DA4BF]">Email: edudigital08@fiec.com.br</p>
        <p class="text-xs text-[#8DA4BF]">Telefone: (19) 99300-8684</p>
        <p class="text-xs text-[#8DA4BF] mb-2">Atendimento: Seg–Sex, 8h às 12h</p>
        <p class="text-xs text-[#3A4F6A]">Este site segue boas práticas de acessibilidade.</p>
      </div>
    </div>
    <div class="max-w-5xl mx-auto px-6 mt-6 pt-4 border-t border-[#1F2C42]">
      <p class="text-xs text-[#3A4F6A] text-center">© 2026 Inclusão Digital • Compromisso com educação e inclusão</p>
    </div>
  </footer>

</body>
</html>
