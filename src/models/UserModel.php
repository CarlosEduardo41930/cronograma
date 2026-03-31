<?php

function getLogin($pdo, $nome, $senha) {
    // Busca o usuário pelo nome
    $sql = "SELECT * FROM usuario WHERE nome = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Define sessões básicas
        $_SESSION['nivel'] = $usuario['nivel'];
        $_SESSION['id_usuario'] = $usuario['id'];

        // Define id_nivel dependendo do tipo de usuário
        if ($usuario['nivel'] === 'professor') {
            $sql2 = "SELECT id FROM professor WHERE fk_usuario_id = ?";
        } else { // aluno
            $sql2 = "SELECT id FROM turma WHERE fk_usuario_id = ?";
        }

        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([$usuario['id']]);
        $nivel = $stmt2->fetch();

        if ($nivel && isset($nivel['id'])) {
            $_SESSION['id_nivel'] = $nivel['id'];
        } else {
            $_SESSION['erro'][] = "Erro: tipo de usuário não encontrado.";

        }

        // Redireciona dependendo do nível
        if ($usuario['nivel'] === 'professor') {
            header("Location: ../public/turmas.php");
            exit();
        } elseif ($usuario['nivel'] === 'aluno') {
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

function getTurma($pdo, $id)
{
    $sql = "SELECT id, turma, descricao FROM turma WHERE fk_professor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function getAulaProfessor($pdo, $id)
{
    $sql = "SELECT * FROM aulas WHERE fk_turma_id = ?  ORDER BY CAST(ordem AS UNSIGNED)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function setCriarAula($pdo, $id, $turma, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao){
    $sql = "INSERT INTO aulas (titulo, descricao, data, tipo, ordem, status, exercicio, slide, correcao, fk_turma_id, fk_professor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo,$descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $turma, $id]);
}
function getAula($pdo, $id){
    $sql = "SELECT * FROM aulas WHERE status = 'ativa' AND id = ?  ORDER BY CAST(ordem AS UNSIGNED)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function upperCriarAula($pdo, $id, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao){
    $sql = "UPDATE aulas SET titulo = ?, descricao = ?, data = ?, tipo = ?, ordem = ?, status = ?, exercicio = ?, slide = ?, correcao = ? WHERE  id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $id]);
}