<?php
require_once '../src/controllers/UserControll.php';
verificarTipo(['administrador']);
criarProfessor();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>EduPortal - Criar Professor</title>
    <script src="https://cdn.tailwindcss.com"></script>
      <link rel="shortcut icon" href="https://i.postimg.cc/MpRFphR6/Logo-digital-Edu-Portal-com-simbolos-educativos.png" type="image/x-icon">
</head>

<body class="bg-gray-900 text-white p-6">
    <div class="flex justify-end gap-4 mb-6">
    <a href="admin_painel.php"
        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm font-semibold">
        ← Voltar
    </a>
    <a href="../src/controllers/logout.php"
        class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-xl font-semibold text-white">
        Sair
    </a>
</div>

    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg">

        <h1 class="text-xl font-bold mb-4">Criar Professor</h1>

        <?php mensagemErro(); ?>
        <?php mensagemSucesso(); ?>

        <form method="POST" class="flex flex-col gap-3">

            <input type="text" name="nome" placeholder="Nome do professor" class="p-2 rounded bg-gray-700">

            <div class="relative">
                <input type="password" id="senha" name="senha" placeholder="Senha"
                    class="p-2 rounded bg-gray-700 w-full pr-10">
                <span onclick="toggleSenha('senha', this)"
                    class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer">
                    👁
                </span>
            </div>

            <div class="relative">
                <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirmar senha"
                    class="p-2 rounded bg-gray-700 w-full pr-10">
                <span onclick="toggleSenha('confirmarSenha', this)"
                    class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer">
                    👁
                </span>
            </div>

            <input type="text" name="tipo" placeholder="Tipo de professor" class="p-2 rounded bg-gray-700">
            <input type="text" name="descricao" placeholder="Descrição" class="p-2 rounded bg-gray-700">

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 p-2 rounded mt-2">Criar</button>
        </form>
    </div>
    <script>
function toggleSenha(id, el) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
        el.textContent = "🙈";
    } else {
        input.type = "password";
        el.textContent = "👁";
    }
}
</script>
</body>

</html>