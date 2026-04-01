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
            // getTipo($pdo);
        }
    }
}


function mensagemErro (){
    if (!empty($_SESSION['erro'])) {
        echo "
        <div class='mb-4 rounded-2xl border border-red-500/30 bg-red-500/10 p-4 shadow-sm'>
            <div class='flex items-start gap-3'>
                
                <!-- Ícone -->
                <div class='mt-0.5 text-red-400'>
                    ⚠️
                </div>

                <!-- Conteúdo -->
                <div class='flex-1'>
                    <h3 class='text-sm font-semibold text-red-400 mb-1'>
                        Ocorreu um erro
                    </h3>

                    <ul class='text-sm text-red-300 space-y-1 list-disc list-inside'>
        ";

        foreach ($_SESSION['erro'] as $erro) {
            echo "<li>" . htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') . "</li>";
        }

        echo "
                    </ul>
                </div>

            </div>
        </div>
        ";

        unset($_SESSION['erro']);
    }
}

function mensagemSucesso() {
    if (!empty($_SESSION['sucesso'])) {
        echo "
        <div class='mb-4 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-green-400 text-sm'>
            ✅ " . htmlspecialchars($_SESSION['sucesso'], ENT_QUOTES, 'UTF-8') . "
        </div>
        ";
        unset($_SESSION['sucesso']);
    }
}

function aulaAluno()
{
    global $pdo;

    $id = $_SESSION['id_nivel'];
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

    $id = $_SESSION['id_nivel'];
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
        echo "<p class='text-xs text-slate-500 mb-2'>Data: " . htmlspecialchars(traduz_data_para_exibir($carde['data']), ENT_QUOTES, 'UTF-8') . " | Ordem: " . htmlspecialchars($carde['ordem'], ENT_QUOTES, 'UTF-8') ." </p>";
        echo "<div class='flex gap-2 mb-2'>";
        echo "<span class='px-2 py-0.5 rounded text-xs' style='background-color: rgb(209,125,43);'>" . htmlspecialchars($carde['tipo'], ENT_QUOTES, 'UTF-8') . "</span>";
        echo "</div>";

        echo "<div class='flex gap-2 justify-between'>";
        echo "<div class='flex gap-2'>";
        if (!empty($carde['exercicio'])) {
        echo "<a href='$exercicio' class='px-3 py-1 bg-green-600 hover:bg-green-700 rounded text-sm'>Exercício</a>";
        }
        if (!empty($carde['slide'])) {
        echo "<a href='$slide' class='px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm'>Slide</a>";
        }
        if (!empty($carde['correcao'])) {
        echo "<a href='$correcao' class='px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm'>Correção</a>";
        }
        echo "</div>";
         echo "<div class='flex justify-end gap-2 pt-2 border-t border-[#1F2C42]'>";

        echo "<a href='editar_aula.php?aula=$idAula&turma=$id' 
                class='px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 rounded-lg text-xs font-semibold text-white transition'>
                ✏️ Editar
              </a>";

        echo "<a href='excluir.php?aula=$idAula&turma=$id' 
                class='px-3 py-1.5 bg-red-500 hover:bg-red-600 rounded-lg text-xs font-semibold text-white transition'>
                🗑️ Excluir
              </a>";

        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

function novaAula(){
     global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_SESSION['id_nivel'];
        $turma = $_GET['turma'];
        $titulo = sanitizar($_POST['titulo']?? '', 'nome');
        $descricao = sanitizar($_POST['descricao']?? '','texto');
        $data = $_POST['data'];
        $tipo = sanitizar($_POST['tipo']?? '', 'texto');
        $ordem = $_POST['ordem'];
        $status = $_POST['status']?? '';
        $exercicio = $_POST['exercicio']?? '';
        $slide = $_POST['slide']?? '';
        $correcao = $_POST['correcao']?? '';

        if (empty($_SESSION['erro'])) {
            setCriarAula($pdo, $id, $turma, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao);
            $_SESSION['sucesso'] = "Salvo com sucesso!";
            echo "<script>
            setTimeout(function() {
            window.location.href = 'turma_aulas.php?turma=$turma';
            }, 2000);
            </script>";

        }
    }
}
function mostrarAula(){
    global $pdo;

    $idAula = $_GET['aula'];
    $aula = getAula($pdo, $idAula);
    // $id = $_SESSION['id_usuario'];

    foreach ($aula as $dados){
        // <!-- Título -->
            echo "<div>";
                echo "<label for='titulo' class='block text-sm mb-1'>Título</label>";
                echo "<input name='titulo' type='text' required  value=" .  htmlspecialchars($dados['titulo'], ENT_QUOTES, 'UTF-8') . " class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' placeholder='Título da aula' />";
            echo "</div>";

            // <!-- Descrição -->
            echo "<div>";
                echo "<label for='descricao' class='block text-sm mb-1'>Descrição</label>";
                echo "<textarea name='descricao' required class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' rows='3' placeholder='Descrição da aula'>" . htmlspecialchars($dados['descricao']) . "</textarea>";
            echo "</div>";

            // <!-- Data -->
            echo "<div>";
                echo "<label for='data' class='block text-sm mb-1'>Data</label>";
                echo "<input name='data' type='date' value=" . htmlspecialchars($dados['data'], ENT_QUOTES, 'UTF-8') . " class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' />";
            echo "</div>";

            // <!-- Tipo -->
            echo "<div>";
                echo "<label for='tipo' class='block text-sm mb-1'>Tipo</label>";
                echo "<input name='tipo' type='text' required value=" . htmlspecialchars($dados['tipo'], ENT_QUOTES, 'UTF-8') . " class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' placeholder='Exel'>";
            echo "</div>";

            // <!-- Ordem -->
            echo "<div>";
                echo "<label for='ordem' class='block text-sm mb-1'>Ordem</label>";
                echo "<input name='ordem' type='number' step='0.1' required value=" . htmlspecialchars($dados['ordem'], ENT_QUOTES, 'UTF-8') . " class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' placeholder='1.0' />";
            echo "</div>";

            // <!-- Status -->
            echo "<div>";
                echo "<label for='status' class='block text-sm mb-1'>Status</label>";
                echo "<select name='status' class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]'>";
                    echo "<option value='ativa'" . ($dados['status'] == 'ativa' ? 'selected' : '') . ">Ativa</option>";
                    echo "<option value='inativa' " . ($dados['status'] == 'inativa' ? 'selected' : '') . ">Inativa</option>";
                echo "</select>";
            echo "</div>";

            // <!-- Exercício -->
            echo "<div>";
                echo "<label for='exercicio' class='block text-sm mb-1'>Exercício (link)</label>";
                echo "<input name='exercicio' type='url' value='" . htmlspecialchars($dados['exercicio'], ENT_QUOTES, 'UTF-8') . "' class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' placeholder='https://' />";
            echo "</div>";

            // <!-- Slide -->
            echo "<div>";
                echo "<label for='slide' class='block text-sm mb-1'>Slide (link)</label>";
                echo "<input name='slide' type='url' value='" . htmlspecialchars($dados['slide'], ENT_QUOTES, 'UTF-8') . "' class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' placeholder='https://' />";
            echo "</div>";

            // <!-- Correção -->
            echo "<div>";
                echo "<label for='correcao' class='block text-sm mb-1'>Correção (link)</label>";
                echo "<input name='correcao' type='url' value='" . htmlspecialchars($dados['correcao'], ENT_QUOTES, 'UTF-8') . "' class='w-full p-3 rounded bg-[#111827] border border-[#1F2C42]' placeholder='https://' />";
            echo "</div>";

    };

}

function editar(){
    global $pdo;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET['aula'];
        $turma = $_GET['turma'];
        $usuario = $_SESSION['id_nivel'];
        $titulo = sanitizar($_POST['titulo']?? '', 'nome');
        $descricao = sanitizar($_POST['descricao']?? '','texto');
        $data = $_POST['data'];
        $tipo = sanitizar($_POST['tipo']?? '', 'texto');
        $ordem = $_POST['ordem'];
        $status = $_POST['status']?? '';
        $exercicio = $_POST['exercicio']?? '';
        $slide = $_POST['slide']?? '';
        $correcao = $_POST['correcao']?? '';

        if (empty($_SESSION['erro'])) {
            upperCriarAula($pdo, $id, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $usuario);
            $_SESSION['sucesso'] = "Salvo com sucesso!";
            echo "<script>
            setTimeout(function() {
            window.location.href = 'turma_aulas.php?turma=$turma';
            }, 2000);
            </script>";

        }
    }

}

function deletarAula(){
    global $pdo;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $aula = $_GET['aula'];
        $turma = $_GET['turma'];
        $usuario = $_SESSION['id_nivel'];
        $delete = deleteAula($pdo, $aula, $usuario);
        if($delete){
            $_SESSION['sucesso'] = "Aula excluido com sucesso!";
            echo "<script>
            setTimeout(function() {
            window.location.href = 'turma_aulas.php?turma=$turma';
            }, 2000);
            </script>";
        }else{
            $_SESSION['erro'][] = "Aula não encontrada";
        }
    }
}