<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EduPortal</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="shortcut icon" href="https://i.postimg.cc/MpRFphR6/Logo-digital-Edu-Portal-com-simbolos-educativos.png" type="image/x-icon">
  <style>
    body { font-family: 'DM Sans', sans-serif; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up  { animation: fadeUp 0.6s ease forwards; }
    .delay-1  { animation-delay: 0.05s; opacity: 0; }
    .delay-2  { animation-delay: 0.2s;  opacity: 0; }
    .delay-3  { animation-delay: 0.35s; opacity: 0; }
    .delay-4  { animation-delay: 0.5s;  opacity: 0; }
    .delay-5  { animation-delay: 0.65s; opacity: 0; }

    .bg-glow {
      position: fixed; top: 30%; left: 50%;
      transform: translate(-50%, -50%);
      width: 700px; height: 700px; border-radius: 50%;
      background: radial-gradient(circle, rgba(59,130,246,0.09) 0%, transparent 70%);
      pointer-events: none; z-index: 0;
    }

    .btn-shine { position: relative; overflow: hidden; }
    .btn-shine::after {
      content: '';
      position: absolute; top: 0; left: -100%;
      width: 60%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
      transform: skewX(-20deg);
      transition: left 0.5s ease;
    }
    .btn-shine:hover::after { left: 160%; }

    .feature-card:hover {
      border-color: rgba(59,130,246,0.4) !important;
      transform: translateY(-3px);
    }
    .feature-card { transition: border-color 0.2s, transform 0.2s; }

    .nav-link { transition: color 0.2s; }
    .nav-link:hover { color: #60A5FA; }
  </style>
</head>
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen">

  <div class="bg-glow"></div>

  <!-- Pontos decorativos -->
  <div class="fixed top-0 right-0 w-72 h-72 opacity-[0.07] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #3B82F6 1px, transparent 1px); background-size: 22px 22px;"></div>
  <div class="fixed bottom-0 left-0 w-72 h-72 opacity-[0.07] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #3B82F6 1px, transparent 1px); background-size: 22px 22px;"></div>

  <!-- NAVBAR -->
  <nav class="relative z-10 border-b border-[#1F2C42] bg-[#0B0F1A]/80 backdrop-blur-sm sticky top-0">
    <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/25">
          <svg class="w-4 h-4 text-blue-400" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <span class="text-lg font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">EduPortal</span>
      </div>
      <div class="hidden sm:flex items-center gap-6 text-sm text-[#8DA4BF]">
        <a href="#sobre"         class="nav-link">Sobre</a>
        <a href="#funcionalidades" class="nav-link">Funcionalidades</a>
        <a href="#como-funciona" class="nav-link">Como funciona</a>
      </div>
      <a href="public/login.php"
         class="btn-shine bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-all duration-200 active:scale-95"
         style="font-family:'Syne',sans-serif;">
        Entrar
      </a>
    </div>
  </nav>

  <!-- HERO -->
  <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-24 text-center" id="sobre">
    <div class="fade-up delay-1 inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold px-3 py-1.5 rounded-full mb-6" style="font-family:'Syne',sans-serif;">
      <span class="w-1.5 h-1.5 rounded-full bg-blue-400 inline-block"></span>
      Plataforma educacional
    </div>

    <h1 class="fade-up delay-2 text-4xl sm:text-5xl font-bold leading-tight mb-5 text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">
      Materiais didáticos<br/>
      <span class="text-blue-400">organizados em um só lugar</span>
    </h1>

    <p class="fade-up delay-3 text-[#8DA4BF] text-base sm:text-lg max-w-xl mx-auto mb-10 leading-relaxed">
      O EduPortal conecta professores e alunos de forma simples. O professor publica slides, atividades e correções — os alunos acessam tudo com facilidade, a qualquer hora.
    </p>

    <div class="fade-up delay-4 flex flex-col sm:flex-row items-center justify-center gap-3">
      <a href="public/login.php"
         class="btn-shine bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm px-6 py-3.5 rounded-xl transition-all duration-200 hover:-translate-y-px active:scale-95 w-full sm:w-auto text-center"
         style="font-family:'Syne',sans-serif;">
        Acessar a plataforma
      </a>
      <a href="#funcionalidades"
         class="text-[#8DA4BF] hover:text-[#E8EFF7] text-sm font-medium px-6 py-3.5 rounded-xl border border-[#1F2C42] hover:border-[#3B4F6A] transition-all duration-200 w-full sm:w-auto text-center">
        Ver funcionalidades
      </a>
    </div>
  </section>

  <!-- STATS -->
  <section class="relative z-10 max-w-5xl mx-auto px-6 pb-20">
    <div class="fade-up delay-4 grid grid-cols-3 gap-4 border border-[#1F2C42] rounded-2xl p-6 bg-[#111827]/50">
      <div class="text-center">
        <p class="text-2xl font-bold text-blue-400" style="font-family:'Syne',sans-serif;">3</p>
        <p class="text-xs text-[#8DA4BF] mt-1">tipos de material</p>
      </div>
      <div class="text-center border-x border-[#1F2C42]">
        <p class="text-2xl font-bold text-blue-400" style="font-family:'Syne',sans-serif;">100%</p>
        <p class="text-xs text-[#8DA4BF] mt-1">via link, sem upload</p>
      </div>
      <div class="text-center">
        <p class="text-2xl font-bold text-blue-400" style="font-family:'Syne',sans-serif;">2</p>
        <p class="text-xs text-[#8DA4BF] mt-1">perfis de acesso</p>
      </div>
    </div>
  </section>

  <!-- FUNCIONALIDADES -->
  <section class="relative z-10 max-w-5xl mx-auto px-6 pb-24" id="funcionalidades">
    <div class="text-center mb-12">
      <p class="text-xs uppercase tracking-widest text-[#8DA4BF] mb-2">O que a plataforma oferece</p>
      <h2 class="text-2xl sm:text-3xl font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Funcionalidades</h2>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

      <!-- Card 1 -->
      <div class="feature-card bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-4">
          <svg class="w-5 h-5" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
        <h3 class="font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Publicação de atividades</h3>
        <p class="text-sm text-[#8DA4BF] leading-relaxed">O professor posta atividades via link externo. Os alunos acessam direto pela plataforma, sem precisar de e-mail ou grupo de WhatsApp.</p>
      </div>

      <!-- Card 2 -->
      <div class="feature-card bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-4">
          <svg class="w-5 h-5" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
          </svg>
        </div>
        <h3 class="font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Slides das aulas</h3>
        <p class="text-sm text-[#8DA4BF] leading-relaxed">Compartilhe apresentações em link do Google Slides, Canva ou qualquer outra plataforma. Fácil de atualizar, sem precisar repostar.</p>
      </div>

      <!-- Card 3 -->
      <div class="feature-card bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-4">
          <svg class="w-5 h-5" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
          </svg>
        </div>
        <h3 class="font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Correções disponíveis</h3>
        <p class="text-sm text-[#8DA4BF] leading-relaxed">Publique o gabarito ou a correção detalhada em link. Os alunos consultam quando quiserem, no próprio ritmo.</p>
      </div>

      <!-- Card 4 -->
      <div class="feature-card bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-4">
          <svg class="w-5 h-5" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
        </div>
        <h3 class="font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Acesso por perfil</h3>
        <p class="text-sm text-[#8DA4BF] leading-relaxed">Login separado para professor e aluno. O professor gerencia conteúdos, o aluno apenas visualiza — sem risco de edição acidental.</p>
      </div>

      <!-- Card 5 -->
      <div class="feature-card bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-4">
          <svg class="w-5 h-5" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
          </svg>
        </div>
        <h3 class="font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Tudo por links</h3>
        <p class="text-sm text-[#8DA4BF] leading-relaxed">Sem upload de arquivos no servidor. Todos os materiais são gerenciados por links externos, deixando o sistema leve e fácil de manter.</p>
      </div>

      <!-- Card 6 -->
      <div class="feature-card bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-4">
          <svg class="w-5 h-5" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
          </svg>
        </div>
        <h3 class="font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Responsivo</h3>
        <p class="text-sm text-[#8DA4BF] leading-relaxed">Interface adaptada para celular, tablet e computador. O aluno acessa os materiais de qualquer dispositivo, sem perder nada.</p>
      </div>

    </div>
  </section>

  <!-- COMO FUNCIONA -->
  <section class="relative z-10 max-w-5xl mx-auto px-6 pb-24" id="como-funciona">
    <div class="text-center mb-12">
      <p class="text-xs uppercase tracking-widest text-[#8DA4BF] mb-2">Simples e direto</p>
      <h2 class="text-2xl sm:text-3xl font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Como funciona</h2>
    </div>

    <div class="grid sm:grid-cols-2 gap-8">
      <!-- Professor -->
      <div class="bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="flex items-center gap-3 mb-5">
          <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <h3 class="font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Para o professor</h3>
        </div>
        <div class="space-y-4">
          <?php foreach ([
            ['1','Acesse com seu login de professor'],
            ['2','Vá ao painel de publicação'],
            ['3','Cole o link do material (slide, atividade ou correção)'],
            ['4','Adicione um título e salve — o aluno já pode ver'],
          ] as [$n, $txt]): ?>
          <div class="flex items-start gap-3">
            <span class="w-6 h-6 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5" style="font-family:'Syne',sans-serif;"><?= $n ?></span>
            <p class="text-sm text-[#8DA4BF] leading-relaxed"><?= $txt ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Aluno -->
      <div class="bg-[#111827] border border-[#1F2C42] rounded-2xl p-6">
        <div class="flex items-center gap-3 mb-5">
          <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
          </div>
          <h3 class="font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Para o aluno</h3>
        </div>
        <div class="space-y-4">
          <?php foreach ([
            ['1','Acesse com seu login de aluno'],
            ['2','Veja os materiais organizados por tipo'],
            ['3','Clique no link para abrir slides, atividades ou correções'],
            ['4','Estude no seu ritmo, quando e onde quiser'],
          ] as [$n, $txt]): ?>
          <div class="flex items-start gap-3">
            <span class="w-6 h-6 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5" style="font-family:'Syne',sans-serif;"><?= $n ?></span>
            <p class="text-sm text-[#8DA4BF] leading-relaxed"><?= $txt ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="relative z-10 max-w-5xl mx-auto px-6 pb-24">
    <div class="bg-[#111827] border border-blue-500/20 rounded-2xl p-10 text-center"
         style="box-shadow: 0 0 60px rgba(59,130,246,0.07);">
      <h2 class="text-2xl sm:text-3xl font-bold text-[#E8EFF7] mb-3" style="font-family:'Syne',sans-serif;">Pronto para começar?</h2>
      <p class="text-[#8DA4BF] text-sm mb-7 max-w-sm mx-auto">Faça login e acesse todos os materiais da turma em um único lugar.</p>
      <a href="public/login.php"
         class="btn-shine inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm px-8 py-3.5 rounded-xl transition-all duration-200 hover:-translate-y-px active:scale-95"
         style="font-family:'Syne',sans-serif;">
        Entrar na plataforma
      </a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="relative z-10 border-t border-[#1F2C42] py-6">
    <div class="max-w-5xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-2">
      <span class="text-sm font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">EduPortal</span>
      <p class="text-xs text-[#3A4F6A]">Plataforma de materiais didáticos &mdash; acesso restrito</p>
    </div>
  </footer>

</body>
</html>