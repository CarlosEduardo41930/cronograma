<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['professor']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>EduPortal — Aulas da Turma</title>
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
    .aula-card { transition: border-color 0.2s, transform 0.2s; }
    .aula-card:hover { border-color: rgba(59,130,246,0.35) !important; transform: translateY(-2px); }
    .nav-link { transition: color 0.2s; }
    .nav-link:hover { color: #60A5FA; }
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
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen flex flex-col">

  <div class="bg-glow"></div>
  <div class="fixed top-0 right-0 w-72 h-72 opacity-[0.05] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #3B82F6 1px, transparent 1px); background-size: 22px 22px;"></div>

  <!-- NAVBAR -->
  <nav class="relative z-10 border-b border-[#1F2C42] bg-[#0B0F1A]/80 backdrop-blur-sm sticky top-0">
    <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/25 flex items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <a href="turmas.php" class="text-sm text-[#8DA4BF] nav-link flex items-center gap-1.5">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Minhas Turmas
        </a>
      </div>
      <a href="../src/controllers/logout.php"
         class="text-sm font-semibold px-4 py-2 rounded-lg border border-red-500/30 text-red-400 hover:bg-red-500/10 transition-all duration-200"
         style="font-family:'Syne',sans-serif;">
        Sair
      </a>
    </div>
  </nav>

  <!-- Conteúdo -->
  <main class="relative z-10 max-w-5xl mx-auto px-6 pt-10 pb-16 w-full flex-1">

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
      <div>
        <p class="text-xs uppercase tracking-widest text-[#8DA4BF] mb-1">Professor</p>
        <h1 class="text-3xl font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">
          <?php mostrarInformacao(); ?>
        </h1>
      </div>
      <a href="cadastrar_aula.php?turma=<?= trim($_GET['turma']) ?>"
         class="btn-shine inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 active:scale-95 whitespace-nowrap"
         style="font-family:'Syne',sans-serif;">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Nova Aula
      </a>
    </div>

    <div class="space-y-4">
      <?php aulaProfessor(); ?>
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
