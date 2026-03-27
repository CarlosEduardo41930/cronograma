<?php
require 'ajudante.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../src/models/UserModel.php';
require '../src/config/conexao.php';




function verificarTipo($niveisPermitidos)
{
    if (!isset($_SESSION['id_usuario'])) { // se o id tiver nulo, manda devolta pro login
        header('Location: login.php');
        exit();
    }
    if (!in_array($_SESSION['nivel'], $niveisPermitidos)) { //verifica se o nivel é permitido, se nao for, vai para acesso_negado
        header('Location: acesso_negado.php');
        exit();
    }
}

function verificarLogadoTipo()
{


    if (!isset($_SESSION['id_usuario'])) {
        return;
    }


    $tipo = $_SESSION['nivel'] ?? 'default';

    switch ($tipo) {
        case 'professor':
            header("Location: turmas.php");
            break;

        case 'aluno':
            header("Location: aluno.php");
            break;
    }
    exit;
}





function login()
{
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST['username']);
        $senha = trim($_POST['password']);

        if (empty($_SESSION['erro'])) {
            getLogin($pdo, $nome, $senha);
        }
    }
}

function aulaAluno()
{
    global $pdo;

    $id = $_SESSION['id_usuario'];
    $dados = getAulaAluno($pdo, $id);

    foreach ($dados as $carde) {
        $exercicio = $carde['exercicio'];
        $slide = $carde['slide'];
        $correcao = $carde['correcao'];


        echo "<div class='p-4 rounded-2xl border border-[#1F2C42] bg-[#161D2E]'> ";
        echo "<h2 class='text-xl font-semibold mb-1'> Aula de: " . htmlspecialchars($carde['titulo'], ENT_QUOTES, 'UTF-8') . "</h2>";
        echo "<p class='text-sm text-slate-400 mb-2'>" . htmlspecialchars($carde['descricao'], ENT_QUOTES, 'UTF-8') . "</p> ";
        echo "<p class='text-xs text-slate-500 mb-2'>Data: " . htmlspecialchars(traduz_data_para_exibir($carde['data']), ENT_QUOTES, 'UTF-8') . " | Tipo: </p> ";
        echo "<div class='flex gap-2 mb-2'> ";
        echo "  <span class='px-2 py-0.5 rounded text-xs' style='background-color: rgb(209,125,43);'>" . htmlspecialchars($carde['tipo'], ENT_QUOTES, 'UTF-8') . "</span> ";
        echo "</div> ";
        echo "<div class='flex gap-2'> ";
        if (!empty($carde['exercicio'])) {
            echo "  <a href='$exercicio' target='_blank' class='px-3 py-1 bg-green-600 hover:bg-green-700 rounded text-sm'>Exercício</a> ";
        }
        if (!empty($carde['slide'])) {
            echo "  <a href='$slide' target='_blank' class='px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm'>Slide</a> ";
        }
        if (!empty($carde['correcao'])) {
            echo "  <a href='$correcao' target='_blank' class='px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm'>Correção</a> ";
        }
        echo "</div> ";
        echo "</div> ";
    }
}

function turmas()
{
    global $pdo;

    $id = $_SESSION['id_usuario'];
    $dados = getTurma($pdo, $id);

    foreach ($dados as $turma) {
        $idTurma = $turma['id'];
        echo "<a href='turma_aulas.php?turma=$idTurma' class='block p-4 rounded-2xl border border-[#1F2C42] bg-[#161D2E] hover:bg-[#1F253A] transition'>";
        echo "<h2 class='text-xl font-semibold'>Turma: " . htmlspecialchars($turma['turma'], ENT_QUOTES, 'UTF-8') . "</h2>";
        echo "<p class='text-sm text-slate-400 mt-1'>Descrição: " . htmlspecialchars($turma['descricao'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "</a>";
    }
}


function aulaProfessor()
{
    global $pdo;

    $id = trim($_GET['turma']);
    $dados = getAulaProfessor($pdo, $id);

    foreach ($dados as $carde) {
        $idAula = $carde['id'];
        $exercicio = $carde['exercicio'];
        $slide = $carde['slide'];
        $correcao = $carde['correcao'];

        echo "<div class='relative p-4 rounded-2xl border border-[#1F2C42] bg-[#161D2E]'>";
        if ($carde['status'] === 'ativa') {
            echo "<span class='absolute top-3 right-3 px-2 py-0.5 rounded-full text-xs font-semibold bg-green-600'>Ativa</span>";
        } else {
            echo "<span class='absolute top-3 right-3 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-600'>Inativa</span>";
        }
        echo "<h2 class='text-xl font-semibold mb-1'> Aula: " . htmlspecialchars($carde['titulo'], ENT_QUOTES, 'UTF-8') . "</h2>";
        echo "<p class='text-sm text-slate-400 mb-2'>" . htmlspecialchars($carde['descricao'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p class='text-xs text-slate-500 mb-2'>Data: " . htmlspecialchars(traduz_data_para_exibir($carde['data']), ENT_QUOTES, 'UTF-8') . " | Tipo: </p>";
        echo "<div class='flex gap-2 mb-2'>";
        echo "<span class='px-2 py-0.5 rounded text-xs' style='background-color: rgb(209,125,43);'>" . htmlspecialchars($carde['tipo'], ENT_QUOTES, 'UTF-8') . "</span>";
        echo "</div>";

        echo "<div class='flex gap-2 justify-between'>";
        echo "<div class='flex gap-2'>";
        echo "<a href='$exercicio' class='px-3 py-1 bg-green-600 hover:bg-green-700 rounded text-sm'>Exercício</a>";
        echo "<a href='$slide' class='px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm'>Slide</a>";
        echo "<a href='$correcao' class='px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm'>Correção</a>";
        echo "</div>";
        echo "<a href='editar_aula.php?aula=$idAula' class='px-3 py-1 bg-blue-300 hover:bg-blue-400 rounded text-sm text-black font-semibold'>Editar Aula</a>";
        echo "</div>";
        echo "</div>";
    }
}
