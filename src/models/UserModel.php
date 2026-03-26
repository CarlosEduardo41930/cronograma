<?php

function getLogin($pdo, $nome, $senha){
    $sql = "SELECT * FROM usuario WHERE nome = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
    
        $_SESSION['nivel'] = $usuario['nivel'];
        $_SESSION['id_usuario'] = $usuario['id'];
    
        if ($usuario['nivel'] == 'professor') {
    
            header("Location: ../public/turmas.php");
            exit();
    
        } elseif ($usuario['nivel'] == 'aluno') {
    
            header("Location: ../public/aluno.php");
            exit();
    
        }
    
    } else {

    $_SESSION['erro'][] = "Usuário ou senha incorretos!";
    }
}