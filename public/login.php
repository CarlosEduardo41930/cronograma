<?php
session_start();
require_once '../src/controllers/UserControll.php';
login();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen text-white">

<div class="bg-gray-800 p-8 rounded-xl w-80 space-y-4">

  <h2 class="text-xl font-bold text-center">Login</h2>

  <form method="POST">

    <!-- Username -->
    <div>
      <label>Usuário</label>
      <input type="text" name="username" required
             class="w-full mt-1 p-2 rounded bg-gray-700">
    </div>

    <!-- Senha -->
    <div>
      <label>Senha</label>
      <input type="password" name="password" required
             class="w-full mt-1 p-2 rounded bg-gray-700">
    </div>

    <!-- Botão -->
    <button type="submit"
            class="w-full bg-blue-500 p-2 rounded hover:bg-blue-600">
      Entrar
    </button>

  </form>

  <!-- Erro -->
  <?php if (!empty($error)): ?>
    <p class="text-red-400 text-sm text-center">
      <?php echo htmlspecialchars($error); ?>
    </p>
  <?php endif; ?>

</div>

</body>
</html>