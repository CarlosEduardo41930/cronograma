const mysql = require('mysql2/promise');

const pool = mysql.createPool({
  host: process.env.DB_HOST || 'sql208.infinityfree.com',
  user: process.env.DB_USER || 'if0_41558661',
  password: process.env.DB_PASSWORD || 'kfPuSJgwumRDMTF',
  database: process.env.DB_NAME || 'if0_41558661_cronograma',
  charset: 'utf8mb4',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

export default async function handler(req, res) {
  if (req.method !== 'DELETE') {
    return res.status(405).json({ error: 'Method not allowed' });
  }

  const authHeader = req.headers.authorization;
  const token = authHeader && authHeader.split(' ')[1];
  
  if (!token) {
    return res.status(401).json({ error: 'Token não fornecido' });
  }
  
  const jwt = require('jsonwebtoken');
  let user;
  try {
    user = jwt.verify(token, process.env.JWT_SECRET || 'a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6');
  } catch (err) {
    return res.status(403).json({ error: 'Token inválido' });
  }

  if (user.nivel !== 'administrador') {
    return res.status(403).json({ error: 'Acesso negado' });
  }

  const match = req.url.match(/\/professor\/(\d+)/);
  if (!match) {
    return res.status(400).json({ error: 'ID do professor não fornecido' });
  }
  const professorId = match[1];

  try {
    const connection = await pool.getConnection();
    await connection.beginTransaction();

    const [usuarioResult] = await connection.execute(
      'SELECT fk_usuario_id FROM professor WHERE id = ?',
      [professorId]
    );

    if (usuarioResult.length === 0) {
      return res.status(404).json({ error: 'Professor não encontrado' });
    }

    const usuarioId = usuarioResult[0].fk_usuario_id;

    const [turmasResult] = await connection.execute(
      'SELECT id, fk_usuario_id FROM turma WHERE fk_professor = ?',
      [professorId]
    );

    const turmasIds = turmasResult.map(t => t.fk_usuario_id);
    
    if (turmasIds.length > 0) {
      await connection.execute('DELETE FROM aulas WHERE fk_professor_id = ?', [professorId]);
      await connection.execute('DELETE FROM turma WHERE fk_professor = ?', [professorId]);
      await connection.execute(`DELETE FROM usuario WHERE id IN (${turmasIds.map(() => '?').join(',')})`, turmasIds);
    }

    await connection.execute('DELETE FROM professor WHERE id = ?', [professorId]);
    await connection.execute('DELETE FROM usuario WHERE id = ?', [usuarioId]);

    await connection.commit();
    connection.release();
    
    res.json({ success: true, message: 'Professor excluído com sucesso' });
  } catch (error) {
    console.error('Erro ao excluir professor:', error);
    res.status(500).json({ error: 'Erro ao excluir professor' });
  }
}