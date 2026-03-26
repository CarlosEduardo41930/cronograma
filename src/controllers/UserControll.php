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