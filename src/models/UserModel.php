<?php

function getLogin($pdo, $nome, $senha)
{
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

function getTipo($pdo)
{
    $nivel = $_SESSION['nivel'];
    $id = $_SESSION['id_usuario'];

    if ($nivel == 'professor') {
        $sql = "SELECT id FROM professor WHERE  fk_usuario_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();

        $_SESSION['id_nivel'] = $usuario['id']; 
    }else{
        $sql = "SELECT id FROM turma WHERE  fk_usuario_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();

        $_SESSION['id_nivel'] = $usuario['id']; 
    }
}

function getAulaAluno($pdo, $id,)
{
    $sql = "SELECT * FROM aulas WHERE status = 'ativa' AND fk_turma_id = ?  ORDER BY CAST(ordem AS UNSIGNED)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function getTurma($pdo, $id)
{
    $sql = "SELECT id, turma, descricao FROM turma WHERE fk_professor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function getAulaProfessor($pdo, $id)
{
    $sql = "SELECT * FROM aulas WHERE fk_professor_id = ?  ORDER BY CAST(ordem AS UNSIGNED)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}
