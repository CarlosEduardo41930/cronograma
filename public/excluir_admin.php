<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['administrador']);
tipoParaDelete();
$tipo = $_GET['tipo'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>EduPortal — Confirmar Exclusão</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="shortcut icon" href="https://i.postimg.cc/MpRFphR6/Logo-digital-Edu-Portal-com-simbolos-educativos.png" type="image/x-icon">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .bg-glow {
      position: fixed; top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 600px; height: 600px; border-radius: 50%;
      background: radial-gradient(circle, rgba(239,68,68,0.06) 0%, transparent 70%);
      pointer-events: none; z-index: 0;
    }
  </style>
</head>
<body class="bg-[#0B0F1A] text-[#E8EFF7] min-h-screen flex items-center justify-center p-6">

  <div class="bg-glow"></div>
  <div class="fixed bottom-0 left-0 w-72 h-72 opacity-[0.04] pointer-events-none z-0"
       style="background-image: radial-gradient(circle, #EF4444 1px, transparent 1px); background-size: 22px 22px;"></div>

  <div class="relative z-10 w-full max-w-md">

    <div class="bg-[#111827] border border-[#1F2C42] rounded-2xl p-8 text-center"
         style="box-shadow: 0 0 60px rgba(239,68,68,0.06);">

      <!-- Ícone -->
      <div class="w-16 h-16 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-5">
        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
      </div>

      <h1 class="text-2xl font-bold text-[#E8EFF7] mb-2" style="font-family:'Syne',sans-serif;">Confirmar Exclusão</h1>
      <p class="text-sm text-[#8DA4BF] mb-1">Tem certeza que deseja excluir este(a) <strong class="text-[#E8EFF7]"><?= htmlspecialchars($tipo) ?></strong>?</p>
      <p class="text-sm text-red-400 font-semibold mb-7">Essa ação não pode ser desfeita.</p>

      <?php mensagemSucesso() ?>
      <?php mensagemErro(); ?>

      <form method="POST" class="flex gap-3">
        <button type="button" onclick="history.back()"
          class="w-full py-3 rounded-xl bg-[#1F2C42] hover:bg-[#2A3A52] text-sm font-semibold transition-all duration-200"
          style="font-family:'Syne',sans-serif;">
          Cancelar
        </button>
        <button name="acao" value="delete" type="submit"
          class="w-full py-3 rounded-xl bg-red-500 hover:bg-red-600 text-sm font-semibold text-white transition-all duration-200 active:scale-95"
          style="font-family:'Syne',sans-serif;">
          Excluir
        </button>
      </form>

    </div>

    <div class="text-center mt-4">
      <a href="admin_painel.php" class="text-xs text-[#3A4F6A] hover:text-[#8DA4BF] transition-colors">
        ← Voltar ao painel
      </a>
    </div>
  </div>

</body>
</html>
