<?php
require 'ajudante.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../src/models/UserModel.php';
require '../src/config/conexao.php';


function verificarTipo($niveisPermitidos)
{
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: login.php');
        exit();
    }
    if (!in_array($_SESSION['nivel'], $niveisPermitidos)) {
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
        case 'administrador':
            header("Location: admin_painel.php");
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


// ─── MENSAGENS ────────────────────────────────────────────────────────────────

function mensagemErro()
{
    if (!empty($_SESSION['erro'])) {
        echo "
        <div class='mb-4 rounded-2xl border border-red-500/30 bg-red-500/10 p-4'>
            <div class='flex items-start gap-3'>
                <div class='w-8 h-8 rounded-lg bg-red-500/15 border border-red-500/20 flex items-center justify-center shrink-0 mt-0.5'>
                    <svg class='w-4 h-4 text-red-400' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z'/>
                    </svg>
                </div>
                <div class='flex-1'>
                    <p class='text-xs uppercase tracking-widest text-red-400 font-semibold mb-1.5'>Ocorreu um erro</p>
                    <ul class='space-y-1'>
        ";

        foreach ($_SESSION['erro'] as $erro) {
            echo "<li class='text-sm text-red-300 flex items-start gap-1.5'><span class='mt-1.5 w-1 h-1 rounded-full bg-red-400 shrink-0 inline-block'></span>" . htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') . "</li>";
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

function mensagemSucesso()
{
    if (!empty($_SESSION['sucesso'])) {
        echo "
        <div class='mb-4 rounded-2xl border border-green-500/30 bg-green-500/10 p-4'>
            <div class='flex items-center gap-3'>
                <div class='w-8 h-8 rounded-lg bg-green-500/15 border border-green-500/20 flex items-center justify-center shrink-0'>
                    <svg class='w-4 h-4 text-green-400' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M5 13l4 4L19 7'/>
                    </svg>
                </div>
                <p class='text-sm text-green-400 font-medium'>" . htmlspecialchars($_SESSION['sucesso'], ENT_QUOTES, 'UTF-8') . "</p>
            </div>
        </div>
        ";
        unset($_SESSION['sucesso']);
    }
}


// ─── ALUNO ────────────────────────────────────────────────────────────────────

function aulaAluno()
{
    global $pdo;
    $id = $_SESSION['id_nivel'];
    $dados = getAulaAluno($pdo, $id);

    foreach ($dados as $carde) {
        $exercicio = htmlspecialchars($carde['exercicio'], ENT_QUOTES, 'UTF-8');
        $slide     = htmlspecialchars($carde['slide'],     ENT_QUOTES, 'UTF-8');
        $correcao  = htmlspecialchars($carde['correcao'],  ENT_QUOTES, 'UTF-8');

        echo "
        <div class='aula-card p-5 rounded-2xl border border-[#1F2C42] bg-[#111827] hover:border-blue-500/30 transition-all duration-200'>
            <div class='flex items-start justify-between gap-3 mb-3'>
                <h2 class='text-base font-bold text-[#E8EFF7]' style='font-family:\"Syne\",sans-serif;'>
                    " . htmlspecialchars($carde['titulo'], ENT_QUOTES, 'UTF-8') . "
                </h2>
                <span class='px-2 py-0.5 rounded-md text-xs font-semibold shrink-0' style='background-color:rgba(209,125,43,0.15); color:rgb(209,125,43); border:1px solid rgba(209,125,43,0.3);'>
                    " . htmlspecialchars($carde['tipo'], ENT_QUOTES, 'UTF-8') . "
                </span>
            </div>

            <p class='text-sm text-[#8DA4BF] mb-3 leading-relaxed'>
                " . htmlspecialchars($carde['descricao'], ENT_QUOTES, 'UTF-8') . "
            </p>

            <p class='text-xs text-[#3A4F6A] mb-4'>
                📅 " . htmlspecialchars(traduz_data_para_exibir($carde['data']), ENT_QUOTES, 'UTF-8') . "
            </p>

            <div class='flex flex-wrap gap-2'>
        ";

        if ($carde['liberarExe'] === 'sim' && !empty($carde['exercicio'])) {
            echo "<a href='$exercicio' target='_blank'
                    class='inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-green-600/80 hover:bg-green-600 border border-green-500/30 transition-all duration-200'>
                    📝 Exercício
                  </a>";
        }
        if ($carde['liberarSli'] === 'sim' && !empty($carde['slide'])) {
            echo "<a href='$slide' target='_blank'
                    class='inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-blue-600/80 hover:bg-blue-600 border border-blue-500/30 transition-all duration-200'>
                    📊 Slide
                  </a>";
        }
        if ($carde['liberarCorr'] === 'sim' && !empty($carde['correcao'])) {
            echo "<a href='$correcao' target='_blank'
                    class='inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-red-600/80 hover:bg-red-600 border border-red-500/30 transition-all duration-200'>
                    ✏️ Correção
                  </a>";
        }

        echo "
            </div>
        </div>
        ";
    }
}


// ─── PROFESSOR ────────────────────────────────────────────────────────────────

function turmas()
{
    global $pdo;

    $id    = $_SESSION['id_nivel'];
    $dados = getTurma($pdo, $id);

    foreach ($dados as $turma) {
        $idTurma = $turma['id'];
        echo "
        <a href='turma_aulas.php?turma=$idTurma'
           class='turma-card group block p-5 rounded-2xl border border-[#1F2C42] bg-[#111827] hover:border-blue-500/30 transition-all duration-200'>
            <div class='flex items-center justify-between'>
                <div>
                    <p class='text-xs uppercase tracking-widest text-[#8DA4BF] mb-1'>Turma</p>
                    <h2 class='text-lg font-bold text-[#E8EFF7] group-hover:text-blue-400 transition-colors' style='font-family:\"Syne\",sans-serif;'>
                        " . htmlspecialchars($turma['turma'], ENT_QUOTES, 'UTF-8') . "
                    </h2>
                    <p class='text-sm text-[#8DA4BF] mt-1'>
                        " . htmlspecialchars($turma['descricao'], ENT_QUOTES, 'UTF-8') . "
                    </p>
                </div>
                <div class='w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0 group-hover:bg-blue-500/20 transition-colors'>
                    <svg class='w-4 h-4 text-blue-400' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M9 5l7 7-7 7'/>
                    </svg>
                </div>
            </div>
        </a>
        ";
    }
}

function aulaProfessor()
{
    global $pdo;

    $id    = trim($_GET['turma']);
    $dados = getAulaProfessor($pdo, $id);

    foreach ($dados as $carde) {
        $idAula   = $carde['id'];
        $exercicio = htmlspecialchars($carde['exercicio'], ENT_QUOTES, 'UTF-8');
        $slide     = htmlspecialchars($carde['slide'],     ENT_QUOTES, 'UTF-8');
        $correcao  = htmlspecialchars($carde['correcao'],  ENT_QUOTES, 'UTF-8');

        $statusClass = $carde['status'] === 'ativa'
            ? "bg-green-500/10 text-green-400 border border-green-500/20"
            : "bg-red-500/10 text-red-400 border border-red-500/20";
        $statusLabel = $carde['status'] === 'ativa' ? 'Ativa' : 'Inativa';

        echo "
        <div class='aula-card p-5 rounded-2xl border border-[#1F2C42] bg-[#111827] hover:border-blue-500/30 transition-all duration-200'>

            <!-- Cabeçalho -->
            <div class='flex items-start justify-between gap-3 mb-3'>
                <div class='flex-1'>
                    <h2 class='text-base font-bold text-[#E8EFF7]' style='font-family:\"Syne\",sans-serif;'>
                        " . htmlspecialchars($carde['titulo'], ENT_QUOTES, 'UTF-8') . "
                    </h2>
                    <p class='text-sm text-[#8DA4BF] mt-1 leading-relaxed'>
                        " . htmlspecialchars($carde['descricao'], ENT_QUOTES, 'UTF-8') . "
                    </p>
                </div>
                <span class='px-2.5 py-1 rounded-lg text-xs font-semibold shrink-0 $statusClass'>
                    $statusLabel
                </span>
            </div>

            <!-- Meta -->
            <div class='flex items-center gap-3 mb-4'>
                <span class='text-xs text-[#3A4F6A]'>📅 " . htmlspecialchars(traduz_data_para_exibir($carde['data']), ENT_QUOTES, 'UTF-8') . "</span>
                <span class='text-[#1F2C42]'>•</span>
                <span class='text-xs text-[#3A4F6A]'>Ordem: " . htmlspecialchars($carde['ordem'], ENT_QUOTES, 'UTF-8') . "</span>
                <span class='px-2 py-0.5 rounded-md text-xs font-semibold' style='background-color:rgba(209,125,43,0.15); color:rgb(209,125,43); border:1px solid rgba(209,125,43,0.3);'>
                    " . htmlspecialchars($carde['tipo'], ENT_QUOTES, 'UTF-8') . "
                </span>
            </div>

            <!-- Rodapé: materiais + ações -->
            <div class='flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-[#1F2C42]'>

                <!-- Links de material -->
                <div class='flex flex-wrap gap-2'>
        ";

        if ($carde['liberarExe'] === 'sim' && !empty($carde['exercicio'])) {
            echo "<a href='$exercicio' target='_blank'
                    class='inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-white bg-green-600/80 hover:bg-green-600 border border-green-500/30 transition-all duration-200'>
                    📝 Exercício
                  </a>";
        }
        if ($carde['liberarSli'] === 'sim' && !empty($carde['slide'])) {
            echo "<a href='$slide' target='_blank'
                    class='inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-white bg-blue-600/80 hover:bg-blue-600 border border-500/30 transition-all duration-200'>
                    📊 Slide
                  </a>";
        }
        if ($carde['liberarCorr'] === 'sim' && !empty($carde['correcao'])) {
            echo "<a href='$correcao' target='_blank'
                    class='inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-white bg-red-600/80 hover:bg-red-600 border border-red-500/30 transition-all duration-200'>
                    ✏️ Correção
                  </a>";
        }

        echo "
                </div>

                <!-- Editar / Excluir -->
                <div class='flex gap-2 shrink-0'>
                    <a href='editar_aula.php?aula=$idAula&turma=$id'
                       class='inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-yellow-500/80 hover:bg-yellow-500 border border-yellow-500/30 transition-all duration-200'>
                        ✏️ Editar
                    </a>
                    <a href='excluir.php?aula=$idAula&turma=$id'
                       class='inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-red-500/80 hover:bg-red-500 border border-red-500/30 transition-all duration-200'>
                        🗑️ Excluir
                    </a>
                </div>

            </div>
        </div>
        ";
    }
}


// ─── ADMIN ────────────────────────────────────────────────────────────────────

function turmasAdmin()
{
    global $pdo;
    $nivel = $_SESSION['nivel'];
    $dados = getTurmaAdmin($pdo, $nivel);

    foreach ($dados as $turma) {
        echo "
        <div class='item-card flex justify-between items-center bg-[#0B0F1A] border border-[#1F2C42] hover:border-blue-500/20 p-3 rounded-xl transition-all duration-150'>
            <div class='flex items-center gap-2.5'>
                <div class='w-7 h-7 rounded-lg bg-blue-500/10 border border-blue-500/15 flex items-center justify-center shrink-0'>
                    <svg class='w-3.5 h-3.5 text-blue-400' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'/>
                    </svg>
                </div>
                <span class='text-sm text-[#E8EFF7] font-medium'>" . htmlspecialchars($turma['nome'], ENT_QUOTES, 'UTF-8') . "</span>
            </div>
            <a href='excluir_admin.php?tipo=turma&turma=" . $turma['id'] . "'
               class='text-xs font-semibold px-3 py-1.5 rounded-lg text-red-400 border border-red-500/20 hover:bg-red-500/10 transition-all duration-150'>
                Excluir
            </a>
        </div>
        ";
    }
}

function professorAdmin()
{
    global $pdo;
    $nivel = $_SESSION['nivel'];
    $dados = getProfessorAdmin($pdo, $nivel);

    foreach ($dados as $professor) {
        echo "
        <div class='item-card flex justify-between items-center bg-[#0B0F1A] border border-[#1F2C42] hover:border-blue-500/20 p-3 rounded-xl transition-all duration-150'>
            <div class='flex items-center gap-2.5'>
                <div class='w-7 h-7 rounded-lg bg-blue-500/10 border border-blue-500/15 flex items-center justify-center shrink-0'>
                    <svg class='w-3.5 h-3.5 text-blue-400' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'/>
                    </svg>
                </div>
                <span class='text-sm text-[#E8EFF7] font-medium'>" . htmlspecialchars($professor['nome'], ENT_QUOTES, 'UTF-8') . "</span>
            </div>
            <a href='excluir_admin.php?tipo=professor&professor=" . $professor['id'] . "'
               class='text-xs font-semibold px-3 py-1.5 rounded-lg text-red-400 border border-red-500/20 hover:bg-red-500/10 transition-all duration-150'>
                Excluir
            </a>
        </div>
        ";
    }
}


// ─── FORMULÁRIO EDITAR AULA ──────────────────────────────────────────────────

function mostrarAula()
{
    global $pdo;

    $idAula = $_GET['aula'];
    $aula   = getAula($pdo, $idAula);

    $fi = "w-full p-3 rounded-xl bg-[#0B0F1A] border border-[#1F2C42] text-[#E8EFF7] text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 placeholder-[#3A4F6A]";
    $lb = "block text-xs uppercase tracking-widest text-[#8DA4BF] mb-1.5";

    foreach ($aula as $dados) {

        echo "<div><label class='$lb'>Título</label>
              <input name='titulo' type='text' required value='" . htmlspecialchars($dados['titulo'], ENT_QUOTES, 'UTF-8') . "' class='$fi' placeholder='Título da aula' /></div>";

        echo "<div><label class='$lb'>Descrição</label>
              <textarea name='descricao' required class='$fi' rows='3' placeholder='Descrição da aula'>" . htmlspecialchars($dados['descricao'], ENT_QUOTES, 'UTF-8') . "</textarea></div>";

        echo "<div class='grid grid-cols-1 sm:grid-cols-3 gap-4'>
                <div><label class='$lb'>Data</label>
                <input name='data' type='date' value='" . htmlspecialchars($dados['data'], ENT_QUOTES, 'UTF-8') . "' class='$fi' /></div>
                <div><label class='$lb'>Tipo</label>
                <input name='tipo' type='text' required value='" . htmlspecialchars($dados['tipo'], ENT_QUOTES, 'UTF-8') . "' class='$fi' placeholder='Ex: Excel' /></div>
                <div><label class='$lb'>Ordem</label>
                <input name='ordem' type='number' step='0.1' required value='" . htmlspecialchars($dados['ordem'], ENT_QUOTES, 'UTF-8') . "' class='$fi' placeholder='1.0' /></div>
              </div>";

        echo "<div><label class='$lb'>Status</label>
              <select name='status' class='$fi'>
                  <option value='ativa'"  . ($dados['status'] == 'ativa'   ? ' selected' : '') . ">Ativa</option>
                  <option value='inativa'" . ($dados['status'] == 'inativa' ? ' selected' : '') . ">Inativa</option>
              </select></div>";

        // Materiais
        foreach ([
            ['exercicio', 'liberarExe', '📝 Exercício', 'green'],
            ['slide',     'liberarSli', '📊 Slide',     'blue'],
            ['correcao',  'liberarCorr','✏️ Correção',  'red'],
        ] as [$campo, $liberar, $label, $cor]) {
            $colorMap = [
                'green' => 'text-green-400',
                'blue'  => 'text-blue-400',
                'red'   => 'text-red-400',
            ];
            $textColor = $colorMap[$cor];

            echo "
            <div class='bg-[#0B0F1A] border border-[#1F2C42] rounded-xl p-4'>
                <p class='text-sm font-semibold $textColor mb-2' style='font-family:\"Syne\",sans-serif;'>$label</p>
                <input name='$campo' type='url' value='" . htmlspecialchars($dados[$campo], ENT_QUOTES, 'UTF-8') . "' class='$fi mb-2' placeholder='https://' />
                <select name='$liberar' class='$fi'>
                    <option value=''>Visibilidade...</option>
                    <option value='sim'" . ($dados[$liberar] == 'sim' ? ' selected' : '') . ">✅ Mostrar para alunos</option>
                    <option value='nao'" . ($dados[$liberar] == 'nao' ? ' selected' : '') . ">🚫 Não mostrar</option>
                </select>
            </div>
            ";
        }
    }
}


// ─── DEMAIS FUNÇÕES (lógica — sem alteração) ──────────────────────────────────

function novaAula()
{
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id          = $_SESSION['id_nivel'];
        $turma       = $_GET['turma'];
        $titulo      = sanitizar($_POST['titulo']    ?? '', 'nome');
        $descricao   = sanitizar($_POST['descricao'] ?? '', 'texto');
        $data        = $_POST['data'];
        $tipo        = sanitizar($_POST['tipo']      ?? '', 'texto');
        $ordem       = $_POST['ordem'];
        $status      = $_POST['status']      ?? '';
        $exercicio   = $_POST['exercicio']   ?? '';
        $slide       = $_POST['slide']       ?? '';
        $correcao    = $_POST['correcao']    ?? '';
        $liberarExe  = $_POST['liberarExe']  ?? '';
        $liberarSli  = $_POST['liberarSli']  ?? '';
        $liberarCorr = $_POST['liberarCorr'] ?? '';

        if (empty($_SESSION['erro'])) {
            $dados = setCriarAula($pdo, $id, $turma, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $liberarExe, $liberarSli, $liberarCorr);
            if ($dados) {
                $_SESSION['sucesso'] = "Aula criada com sucesso!";
                echo "<script>setTimeout(function(){ window.location.href='turma_aulas.php?turma=$turma'; }, 2000);</script>";
            }
        }
    }
}

function editar()
{
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id          = $_GET['aula'];
        $turma       = $_GET['turma'];
        $usuario     = $_SESSION['id_nivel'];
        $titulo      = sanitizar($_POST['titulo']    ?? '', 'nome');
        $descricao   = sanitizar($_POST['descricao'] ?? '', 'texto');
        $data        = $_POST['data'];
        $tipo        = sanitizar($_POST['tipo']      ?? '', 'texto');
        $ordem       = $_POST['ordem'];
        $status      = $_POST['status']      ?? '';
        $exercicio   = $_POST['exercicio']   ?? '';
        $slide       = $_POST['slide']       ?? '';
        $correcao    = $_POST['correcao']    ?? '';
        $liberarExe  = $_POST['liberarExe']  ?? '';
        $liberarSli  = $_POST['liberarSli']  ?? '';
        $liberarCorr = $_POST['liberarCorr'] ?? '';

        if (empty($_SESSION['erro'])) {
            upperCriarAula($pdo, $id, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $usuario, $liberarExe, $liberarSli, $liberarCorr);
            $_SESSION['sucesso'] = "Salvo com sucesso!";
            echo "<script>setTimeout(function(){ window.location.href='turma_aulas.php?turma=$turma'; }, 2000);</script>";
        }
    }
}

function deletarAula()
{
    global $pdo;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $aula    = $_GET['aula'];
        $turma   = $_GET['turma'];
        $usuario = $_SESSION['id_nivel'];
        $delete  = deleteAula($pdo, $aula, $usuario);
        if ($delete) {
            $_SESSION['sucesso'] = "Aula excluido com sucesso!";
            echo "<script>setTimeout(function(){ window.location.href='turma_aulas.php?turma=$turma'; }, 2000);</script>";
        } else {
            $_SESSION['erro'][] = "Aula não encontrada";
        }
    }
}

function criarProfessor()
{
    global $pdo;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome      = sanitizar($_POST['nome']      ?? '', 'nome');
        validarSenha($_POST['senha']);
        confirmarSenha($_POST['senha'], $_POST['confirmarSenha']);
        $tipo      = sanitizar($_POST['tipo']      ?? '', 'texto');
        $profe     = "professor";
        $descricao = sanitizar($_POST['descricao'] ?? '', 'texto');
        $nivel     = $_SESSION['nivel'];

        if (empty($_SESSION['erro'])) {
            $hashSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $dados     = setProfessor($pdo, $nome, $hashSenha, $profe, $tipo, $descricao, $nivel);
            if ($dados) {
                $_SESSION['sucesso'] = "Professor cadastrado com sucesso!";
                echo "<script>setTimeout(function(){ window.location.href='admin_painel.php'; }, 2000);</script>";
            }
        }
    }
}

function professores()
{
    global $pdo;
    $nivel = $_SESSION['nivel'];
    $dados = getProfessor($pdo, $nivel);
    if (empty($_SESSION['erro'])) {
        foreach ($dados as $professor) {
            echo "<option value='" . $professor['id'] . "'>" . htmlspecialchars($professor['nome'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
    }
}

function criarTurma()
{
    global $pdo;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome      = sanitizar($_POST['nome']      ?? '', 'nome');
        validarSenha($_POST['senha']);
        confirmarSenha($_POST['senha'], $_POST['confirmarSenha']);
        $turma     = sanitizar($_POST['turma']     ?? '', 'texto');
        $tipo      = "aluno";
        $descricao = sanitizar($_POST['descricao'] ?? '', 'texto');
        $nivel     = $_SESSION['nivel'];
        $professor = temNumero($_POST['professor']);

        if (empty($_SESSION['erro'])) {
            $hashSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $dados     = setTurma($pdo, $nome, $hashSenha, $turma, $tipo, $descricao, $nivel, $professor);
            if ($dados) {
                $_SESSION['sucesso'] = "Turma cadastrado com sucesso!";
                echo "<script>setTimeout(function(){ window.location.href='admin_painel.php'; }, 2000);</script>";
            }
        }
    }
}

function tipoParaDelete()
{
    global $pdo;
    $nivel = $_SESSION['nivel'];
    $tipo  = $_GET['tipo'];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if ($tipo === 'turma') {
            $idTipo = $_GET['turma'];
            $dados  = deleteTurma($pdo, $idTipo, $nivel);
        } elseif ($tipo === 'professor') {
            $idTipo = $_GET['professor'];
            $dados  = deleteProfessor($pdo, $idTipo, $nivel);
        } else {
            $_SESSION['erro'][] = "Tipo de usuário não permitido.";
        }
        if ($dados) {
            $_SESSION['sucesso'] = $tipo . " excluido com sucesso!";
            echo "<script>setTimeout(function(){ window.location.href='admin_painel.php'; }, 2000);</script>";
        }
    }
}

function mostrarInformacao()
{
    global $pdo;
    $id    = trim($_GET['turma']);
    $dados = getNomeTurma($pdo, $id);
    echo htmlspecialchars($dados['turma'] . " — " . $dados['descricao'], ENT_QUOTES, 'UTF-8');
}