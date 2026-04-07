<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['administrador']);
criarProfessor();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>EduPortal — Criar Professor</title>
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
    .field-input {
      background: #111827; border: 1px solid #1F2C42; color: #E8EFF7;
      transition: border-color 0.2s, box-shadow 0.2s; width: 100%; padding: 0.75rem; border-radius: 0.5rem;
    }
    .field-input::placeholder { color: #3A4F6A; }
    .field-input:focus { outline: none; border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }
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
    <div class="max-w-3xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/25 flex items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <span class="text-lg font-bold" style="font-family:'Syne',sans-serif;">EduPortal</span>
      </div>
      <div class="flex items-center gap-3">
        <a href="admin_painel.php" class="flex items-center gap-1.5 text-sm text-[#8DA4BF] hover:text-[#E8EFF7] transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Painel
        </a>
        <a href="../src/controllers/logout.php"
           class="text-sm font-semibold px-4 py-2 rounded-lg border border-red-500/30 text-red-400 hover:bg-red-500/10 transition-all duration-200"
           style="font-family:'Syne',sans-serif;">
          Sair
        </a>
      </div>
    </div>
  </nav>

  <div class="relative z-10 max-w-3xl mx-auto px-6 pt-10 pb-16">

    <div class="mb-8">
      <p class="text-xs uppercase tracking-widest text-[#8DA4BF] mb-1">Administração</p>
      <h1 class="text-3xl font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Criar Professor</h1>
    </div>

    <?php mensagemErro(); ?>
    <?php mensagemSucesso(); ?>

    <div class="bg-[#111827] border border-[#1F2C42] rounded-2xl p-8">
      <form method="POST" class="space-y-4">

        <div>
          <label class="block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5">Nome do professor</label>
          <input type="text" name="nome" placeholder="Nome completo" class="field-input" />
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5">Senha</label>
          <div class="relative">
            <input type="password" id="senha" name="senha" placeholder="Mínimo 6 caracteres" class="field-input pr-11" />
            <button type="button" onclick="toggleSenha('senha', this)"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-[#3A4F6A] hover:text-[#8DA4BF] transition-colors text-base">👁</button>
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5">Confirmar senha</label>
          <div class="relative">
            <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Repita a senha" class="field-input pr-11" />
            <button type="button" onclick="toggleSenha('confirmarSenha', this)"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-[#3A4F6A] hover:text-[#8DA4BF] transition-colors text-base">👁</button>
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5">Tipo / Disciplina</label>
          <input type="text" name="tipo" placeholder="Ex: Matemática" class="field-input" />
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5">Descrição</label>
          <input type="text" name="descricao" placeholder="Breve descrição" class="field-input" />
        </div>

        <button type="submit"
          class="btn-shine w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm py-3.5 rounded-xl transition-all duration-200 hover:-translate-y-px active:scale-95 mt-2"
          style="font-family:'Syne',sans-serif;">
          Criar Professor
        </button>

      </form>
    </div>
  </div>

  <script>
    function toggleSenha(id, el) {
      const input = document.getElementById(id);
      if (input.type === "password") { input.type = "text"; el.textContent = "🙈"; }
      else { input.type = "password"; el.textContent = "👁"; }
    }
  </script>
</body>
</html>
