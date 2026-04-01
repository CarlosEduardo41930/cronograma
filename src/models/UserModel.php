<?php

function getLogin($pdo, $nome, $senha)
{
    $sql = "SELECT * FROM usuario WHERE nome = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome]);
    $usuario = $stmt->fetch();

    // ✅ IF PRINCIPAL
    if ($usuario && password_verify($senha, $usuario['senha'])) {

        $_SESSION['nivel'] = $usuario['nivel'];
        $_SESSION['id_usuario'] = $usuario['id'];

        // Buscar id_nivel
        if ($usuario['nivel'] === 'professor') {
            $sql2 = "SELECT id FROM professor WHERE fk_usuario_id = ?";
        } else {
            $sql2 = "SELECT id FROM turma WHERE fk_usuario_id = ?";
        }

        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([$usuario['id']]);
        $nivel = $stmt2->fetch();

        $_SESSION['id_nivel'] = $nivel['id'] ?? null;

        // Redirecionamento
        if ($usuario['nivel'] === 'professor') {
            header("Location: ../public/turmas.php");
            exit();
        } elseif ($usuario['nivel'] === 'aluno') {
            header("Location: ../public/aluno.php");
            exit();
        } elseif ($usuario['nivel'] === 'administrador') {
            header("Location: ../public/admin_painel.php");
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

function setCriarAula($pdo, $id, $turma, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao,$liberarExe, $liberarSli, $liberarCorr)
{
    if (!$id || !is_numeric($id)) {
        $_SESSION['erro'][] = "ID do professor inválido.";
        exit;
    }
    if (!$turma || !is_numeric($turma)) {
        $_SESSION['erro'][] = "ID da turma inválido.";
        exit;
    }

    $sql = "INSERT INTO aulas (titulo, descricao, data, tipo, ordem, status, exercicio, slide, correcao, fk_turma_id, fk_professor_id, liberarExe, liberarSli, liberarCorr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $turma, $id,$liberarExe, $liberarSli, $liberarCorr]);
    if (!$sucesso) {
        $_SESSION['erro'][] = "Erro ao criar a aula.";
        return false;
    }

    $_SESSION['sucesso'][] = "Aula criada com sucesso!";
    return true;
}

function getAula($pdo, $id)
{
    $sql = "SELECT * FROM aulas WHERE status = 'ativa' AND id = ?  ORDER BY CAST(ordem AS UNSIGNED)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function upperCriarAula($pdo, $id, $titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $usuario, $liberarExe, $liberarSli, $liberarCorr)
{
    if (!$id || !is_numeric($id)) {
        $_SESSION['erro'][] = "ID inválido.";
        exit;
    }

    $sql = "UPDATE aulas SET titulo = ?, descricao = ?, data = ?, tipo = ?, ordem = ?, status = ?, exercicio = ?, slide = ?, correcao = ?, liberarExe = ?, liberarSli = ?, liberarCorr = ? WHERE  id = ? and fk_professor_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $liberarExe, $liberarSli, $liberarCorr, $id, $usuario]);
    if ($stmt->rowCount() === 0) {
        $_SESSION['erro'][] = "Acesso negado ou aula não encontrada.";
        exit;
    }
}
function deleteAula($pdo, $aula, $usuario)
{
    if (!$aula || !is_numeric($aula)) {
        $_SESSION['erro'][] = "ID inválido.";
        return false;
    }

    $sql = "DELETE FROM aulas WHERE id = ? and fk_professor_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$aula, $usuario]);

    if ($stmt->rowCount() === 0) {
        $_SESSION['erro'][] = "Acesso negado ou aula não encontrada.";
        return false;
    }
    return true;
}

function setProfessor($pdo, $nome, $hashSenha, $profe, $tipo, $descricao, $nivel){
    if (!$nivel === 'administrador'){
        $_SESSION['erro'][] = "Nivel não permitido.";
    }

    $sql = "INSERT INTO usuario (nome, senha, nivel) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$nome, $hashSenha, $profe]);
    if (!$sucesso) {
        $_SESSION['erro'][] = "Erro ao criar o Professor.";
        return false;
    }
    $idUsuario = $pdo->lastInsertId();
    $sql = "INSERT INTO professor (tipo, descricao, fk_usuario_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $suceso = $stmt->execute([$tipo, $descricao, $idUsuario]);
    if (!$suceso) {
        $_SESSION['erro'][] = "Erro ao criar o Professor.";
        return false;
    }
    return true;
}