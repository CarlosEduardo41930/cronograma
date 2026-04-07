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
        return false;
    }
    if (!$turma || !is_numeric($turma)) {
        $_SESSION['erro'][] = "ID da turma inválido.";
        return false;
    }

    try{
    $sql = "INSERT INTO aulas (titulo, descricao, data, tipo, ordem, status, exercicio, slide, correcao, fk_turma_id, fk_professor_id, liberarExe, liberarSli, liberarCorr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $turma, $id,$liberarExe, $liberarSli, $liberarCorr]);
    if (!$sucesso) {
        throw new Exception("Erro ao criar a aula.");
    }
    return true;
    }catch(Exception $e){
        $_SESSION['erro'][] = $e->getMessage();
        return false;
    }
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

    try{
    $sql = "UPDATE aulas SET titulo = ?, descricao = ?, data = ?, tipo = ?, ordem = ?, status = ?, exercicio = ?, slide = ?, correcao = ?, liberarExe = ?, liberarSli = ?, liberarCorr = ? WHERE  id = ? and fk_professor_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $descricao, $data, $tipo, $ordem, $status, $exercicio, $slide, $correcao, $liberarExe, $liberarSli, $liberarCorr, $id, $usuario]);
    if ($stmt->rowCount() === 0) {
        throw new Exception("Acesso negado ou aula não encontrada.");
    }
    }catch(Exception $e){
        $_SESSION['erro'][] = $e->getMessage();
    }

}
function deleteAula($pdo, $aula, $usuario)
{
    if (!$aula || !is_numeric($aula)) {
        $_SESSION['erro'][] = "ID inválido.";
        return false;
    }

    try{
    $sql = "DELETE FROM aulas WHERE id = ? and fk_professor_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$aula, $usuario]);

    if ($stmt->rowCount() === 0) {
        throw new Exception("Acesso negado ou aula não encontrada.");
    }
    return true;
    }catch(Exception $e){
        $_SESSION['erro'][] = $e->getMessage();
        return false;
    }
}

function setProfessor($pdo, $nome, $hashSenha, $profe, $tipo, $descricao, $nivel){
    if ($nivel !== 'administrador'){
        $_SESSION['erro'][] = "Nivel não permitido.";
        return false;
    }

    try{
        $pdo->beginTransaction();
    $sql = "INSERT INTO usuario (nome, senha, nivel) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$nome, $hashSenha, $profe]);
    if (!$sucesso) {
       throw new Exception("Erro ao criar o Professor.");
    }
    $idUsuario = $pdo->lastInsertId();
    $sql = "INSERT INTO professor (tipo, descricao, fk_usuario_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $suceso = $stmt->execute([$tipo, $descricao, $idUsuario]);
    if (!$suceso) {
        throw new Exception("Erro ao criar o Professor.");
    }
    $pdo->commit();
    return true;
    }catch(Exception $e){
        $pdo->rollBack();
         $_SESSION['erro'][] =$e->getMessage();
         return false;
    }

}
function getProfessor($pdo, $nivel){
    if ($nivel !== 'administrador'){
        $_SESSION['erro'][] = "Nivel não permitido.";
    }

    $sql = "SELECT p.id as id, u.nome as nome FROM professor p LEFT JOIN usuario u ON p.fk_usuario_id = u.id ORDER BY nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();

}

function setTurma($pdo, $nome, $hashSenha, $turma, $tipo, $descricao, $nivel, $professor) {
    if ($nivel !== 'administrador'){
        $_SESSION['erro'][] = "Nivel não permitido.";
        return false;
    }

     try{
        $pdo->beginTransaction();
    $sql = "INSERT INTO usuario (nome, senha, nivel) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$nome, $hashSenha, $tipo]);
    if (!$sucesso) {
       throw new Exception("Erro ao criar o usuario da Turma.");
    }
    $idUsuario = $pdo->lastInsertId();
    $sql = "INSERT INTO turma (turma, descricao, fk_usuario_id, fk_professor) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $suceso = $stmt->execute([$turma, $descricao, $idUsuario, $professor]);
    if (!$suceso) {
        throw new Exception("Erro ao criar a Turma.");
    }
    $pdo->commit();
    return true;
    }catch(Exception $e){
        $pdo->rollBack();
         $_SESSION['erro'][] =$e->getMessage();
         return false;
    }
    
}

function getTurmaAdmin($pdo, $nivel)
{
    if ($nivel !== 'administrador'){
        $_SESSION['erro'][] = "Nivel não permitido.";
        return;
    }
    $sql = "SELECT tur.id as id, user.nome as nome FROM turma tur LEFT JOIN usuario user ON user.id = tur.fk_usuario_id WHERE user.nivel = 'aluno'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getProfessorAdmin($pdo, $nivel){
    if ($nivel !== 'administrador'){
        $_SESSION['erro'][] = "Nivel não permitido.";
        return;
    }
    $sql = "SELECT prof.id as id, user.nome as nome FROM professor prof LEFT JOIN usuario user ON user.id = prof.fk_usuario_id WHERE user.nivel = 'professor'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function deleteProfessor($pdo, $professor, $nivel)
{
    if (!$professor || !is_numeric($professor)) {
        $_SESSION['erro'][] = "ID inválido.";
        return false;
    }

    if ($nivel !== 'administrador') {
        $_SESSION['erro'][] = "Nível não permitido.";
        return false;
    }

    try {
        $pdo->beginTransaction();

        // 🔹 pegar usuario do professor
        $stmt = $pdo->prepare("SELECT fk_usuario_id FROM professor WHERE id = ?");
        $stmt->execute([$professor]);
        $usuarioProfessor = $stmt->fetchColumn();

        if (!$usuarioProfessor) {
            throw new Exception("Professor não encontrado.");
        }

        // 🔹 pegar usuarios das turmas desse professor
        $stmt = $pdo->prepare("SELECT fk_usuario_id FROM turma WHERE fk_professor = ?");
        $stmt->execute([$professor]);
        $usuariosTurma = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // 🔹 deletar aulas
        $pdo->prepare("DELETE FROM aulas WHERE fk_professor_id = ?")
            ->execute([$professor]);

        // 🔹 deletar turmas
        $pdo->prepare("DELETE FROM turma WHERE fk_professor = ?")
            ->execute([$professor]);

        // 🔹 deletar usuarios das turmas
        if (!empty($usuariosTurma)) {
            $in = str_repeat('?,', count($usuariosTurma) - 1) . '?';
            $pdo->prepare("DELETE FROM usuario WHERE id IN ($in)")
                ->execute($usuariosTurma);
        }

        // 🔹 deletar professor
        $pdo->prepare("DELETE FROM professor WHERE id = ?")
            ->execute([$professor]);

        // 🔹 deletar usuario do professor
        $pdo->prepare("DELETE FROM usuario WHERE id = ?")
            ->execute([$usuarioProfessor]);

        $pdo->commit();
        return true;

    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['erro'][] = $e->getMessage();
        return false;
    }
}

function deleteTurma($pdo, $turma, $nivel)
{
    if (!$turma || !is_numeric($turma)) {
        $_SESSION['erro'][] = "ID inválido.";
        return false;
    }
    if ($nivel !== 'administrador'){
        $_SESSION['erro'][] = "Nivel não permitido.";
        return false;
    }

    try {
        $pdo->beginTransaction();

        // pegar usuario vinculado
        $stmt = $pdo->prepare("SELECT fk_usuario_id FROM turma WHERE id = ?");
        $stmt->execute([$turma]);
        $usuario = $stmt->fetchColumn();

        if (!$usuario) {
            throw new Exception("Turma não encontrada.");
        }

        // deletar aulas da turma
        $pdo->prepare("DELETE FROM aulas WHERE fk_turma_id = ?")
            ->execute([$turma]);

        // deletar turma
        $pdo->prepare("DELETE FROM turma WHERE id = ?")
            ->execute([$turma]);

        // deletar usuario
        $pdo->prepare("DELETE FROM usuario WHERE id = ?")
            ->execute([$usuario]);

        $pdo->commit();
        return true;

    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['erro'][] = $e->getMessage();
        return false;
    }
}

function getNomeTurma($pdo, $id){
    $sql = "SELECT turma, descricao FROM turma WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}
