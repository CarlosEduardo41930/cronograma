<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../src/models/UserModel.php';
require '../src/config/conexao.php';


function login(){
    global $pdo;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = trim($_POST['username']);
        $senha = trim($_POST['password']);

        if(empty($_SESSION['erro'])){
            getLogin($pdo, $nome, $senha);
        }

    }

}

function aulaAluno(){
    global $pdo;

    $id = $_SESSION['id_usuario'];
    $dados = getAulaAluno($pdo, $id);

    foreach($dados as $carde){

  echo "<div class='p-4 rounded-2xl border border-[#1F2C42] bg-[#161D2E]'> ";
  echo "<h2 class='text-xl font-semibold mb-1'>" . htmlspecialchars($carde['titulo']) . "</h2>";
  echo "<p class='text-sm text-slate-400 mb-2'>" . htmlspecialchars($carde['descricao']) . "</p> ";
  echo "<p class='text-xs text-slate-500 mb-2'> " . htmlspecialchars($carde['descricao']) . "Data: 25/03/2026 | Tipo: Exercício</p> ";
  echo "<div class='flex gap-2 mb-2'> ";
  echo "  <span class='px-2 py-0.5 rounded text-xs' style='background-color: rgb(209,125,43);'>Excel</span> ";
  echo "  <span class='px-2 py-0.5 rounded text-xs' style='background-color: rgb(209,125,43);'>Word</span> ";
  echo "</div> ";
  echo "<div class='flex gap-2'> ";
  if(!empty($carde['exercicio'])){
  echo "  <a href='#' class='px-3 py-1 bg-green-600 hover:bg-green-700 rounded text-sm'>Exercício</a> ";
  }
   if(!empty($carde['slide'])){
  echo "  <a href='#' class='px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm'>Slide</a> ";
   }
   if(!empty($carde['slide'])){
  echo "  <a href='#' class='px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm'>Correção</a> ";
   }
  echo "</div> ";
  echo "div> ";

    }

}

