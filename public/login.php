<?php
require_once '../src/controllers/UserControll.php';
login();
verificarLogadoTipo();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduPortal — Login</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
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
      position: fixed; top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 700px; height: 700px; border-radius: 50%;
      background: radial-gradient(circle, rgba(59,130,246,0.09) 0%, transparent 70%);
      pointer-events: none; z-index: 0;
    }

    .field-input {
      background: #111827;
      border: 1px solid #1F2C42;
      color: #E8EFF7;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .field-input::placeholder { color: #3A4F6A; }
    .field-input:focus {
      outline: none;
      border-color: #3B82F6;
      box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
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
  </style>
</head>
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen flex items-center justify-center px-4 py-10">

  <div class="bg-glow"></div>

  <!-- Pontos decorativos -->
  <div class="fixed top-0 right-0 w-72 h-72 opacity-[0.07] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #3B82F6 1px, transparent 1px); background-size: 22px 22px;"></div>
  <div class="fixed bottom-0 left-0 w-72 h-72 opacity-[0.07] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #3B82F6 1px, transparent 1px); background-size: 22px 22px;"></div>

  <div class="relative z-10 w-full max-w-md">

    <!-- Logo -->
    <div class="text-center mb-8 fade-up delay-1">
      <a href="../index.php" class="inline-flex flex-col items-center gap-3">
        <div class="w-14 h-14 rounded-2xl bg-blue-500/10 border border-blue-500/25 flex items-center justify-center">
          <svg class="w-7 h-7" fill="none" stroke="#60A5FA" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <div>
          <h1 class="text-3xl font-bold tracking-tight text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">EduPortal</h1>
          <p class="text-sm text-[#8DA4BF] mt-0.5">Plataforma de materiais didáticos</p>
        </div>
      </a>
    </div>

    <!-- Card -->
    <div class="fade-up delay-2 bg-[#111827] border border-[#1F2C42] rounded-2xl p-8"
         style="box-shadow: 0 8px 40px rgba(0,0,0,0.5);">

      <div class="mb-6">
        <h2 class="text-lg font-bold text-[#E8EFF7]" style="font-family:'Syne',sans-serif;">Bem-vindo de volta</h2>
        <p class="text-sm text-[#8DA4BF] mt-1">Entre com suas credenciais para acessar</p>
      </div>

      <form method="POST" class="space-y-4">

        <!-- Usuário -->
        <div class="fade-up delay-3">
          <label class="block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5">Usuário</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#3A4F6A]">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </span>
            <input name="username" type="text" placeholder="seu usuário" required
              class="field-input w-full text-sm rounded-xl pl-10 pr-4 py-3" />
          </div>
        </div>

        <!-- Senha -->
        <div class="fade-up delay-4">
          <label class="block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5">Senha</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#3A4F6A]">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </span>
            <input id="password" name="password" type="password" placeholder="••••••••" required
              class="field-input w-full text-sm rounded-xl pl-10 pr-11 py-3" />
            <button type="button" onclick="togglePassword()"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-[#3A4F6A] hover:text-[#8DA4BF] transition-colors">
              <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Erro PHP -->
        <?php mensagemErro(); ?>

        <!-- Botão -->
        <div class="fade-up delay-5 pt-1">
          <button type="submit"
            class="btn-shine w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm py-3.5 rounded-xl transition-all duration-200 hover:-translate-y-px active:scale-95"
            style="font-family:'Syne',sans-serif;">
            Entrar na plataforma
          </button>
        </div>

      </form>
    </div>

    <p class="text-center text-xs mt-6 text-[#3A4F6A] fade-up delay-5">
      Acesso restrito a alunos e professores cadastrados.<br/>
      Problemas? Fale com o administrador.
    </p>
  </div>

  <script>
    let visible = false;
    function togglePassword() {
      visible = !visible;
      document.getElementById('password').type = visible ? 'text' : 'password';
      document.getElementById('eye-icon').innerHTML = visible
        ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.26-3.676M6.11 6.11A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.955 9.955 0 01-4.512 5.568M6.11 6.11L3 3m3.11 3.11l4.95 4.95M17.89 17.89l3.11 3.11m-3.11-3.11l-4.95-4.95"/>`
        : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    }
  </script>
</body>
</html>
