<?php

function getLogin($pdo, $nome, $senha)
{
    $sql = "SELECT * FROM usuario WHERE nome = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {

        $_SESSION['nivel'] = $usuario['nivel'];


        if ($usuario['nivel'] == 'professor') {
            $_SESSION['id_usuario'] = $usuario['id'];
            header("Location: ../public/turmas.php");
            exit();
        } elseif ($usuario['nivel'] == 'aluno') {
            $idAluno = ($usuario['id'] - 1);
            $_SESSION['id_usuario'] = $idAluno;
            header("Location: ../public/aluno.php");
            exit();
        }
    } else {

        $_SESSION['erro'][] = "Usuário ou senha incorretos!";
    }
}

function getAulaAluno($pdo, $id,)
{
    $sql = "SELECT * FROM aulas WHERE status = 'ativa' AND fk_turma_id = ?  ORDER BY CAST(ordem AS UNSIGNED)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function getTurma($pdo, $id){
    $sql = "SELECT id, turma, descricao FROM turma WHERE fk_professor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function getAulaProfessor($pdo, $id){
    $sql = "SELECT * FROM aulas WHERE fk_professor_id = ?  ORDER BY CAST(ordem AS UNSIGNED)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}