<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>403 — Acesso Negado</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .bg-glow {
      position: fixed; top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 600px; height: 600px; border-radius: 50%;
      background: radial-gradient(circle, rgba(239,68,68,0.06) 0%, transparent 70%);
      pointer-events: none; z-index: 0;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.5s ease forwards; }
  </style>
</head>
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen flex items-center justify-center p-6">

  <div class="bg-glow"></div>
  <div class="fixed bottom-0 right-0 w-72 h-72 opacity-[0.04] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #EF4444 1px, transparent 1px); background-size: 22px 22px;"></div>

  <div class="relative z-10 w-full max-w-md text-center fade-up">

    <!-- Código -->
    <p class="text-8xl font-bold text-red-500/20 mb-0 leading-none select-none" style="font-family:'Syne',sans-serif;">403</p>

    <div class="bg-[#111827] border border-[#1F2C42] rounded-2xl p-8 -mt-4"
         style="box-shadow: 0 0 60px rgba(239,68,68,0.06);">

      <!-- Ícone -->
      <div class="w-16 h-16 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-5">
        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
      </div>

      <h2 class="text-2xl font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Acesso Negado</h2>
      <p class="text-sm text-[#8DA4BF] mb-7 leading-relaxed">
        Você não tem permissão para acessar esta página.<br/>
        Se acredita que isso é um erro, entre em contato com o administrador.
      </p>

      <div class="flex gap-3 justify-center">
        <button onclick="history.back()"
          class="px-5 py-2.5 rounded-xl bg-[#1F2C42] hover:bg-[#2A3A52] text-sm font-semibold transition-all duration-200"
          style="font-family:'Syne',sans-serif;">
          ← Voltar
        </button>
        <a href="login.php"
          class="px-5 py-2.5 rounded-xl bg-blue-500 hover:bg-blue-600 text-sm font-semibold text-white transition-all duration-200 active:scale-95"
          style="font-family:'Syne',sans-serif;">
          Ir para o Login
        </a>
      </div>

    </div>
  </div>

</body>
</html>
