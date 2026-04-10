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
  if (req.method !== 'PUT') {
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

  if (user.nivel !== 'professor') {
    return res.status(403).json({ error: 'Acesso negado' });
  }

  const { titulo, descricao, data, tipo, ordem, status, exercicio, slide, correcao, liberarExe, liberateSli, liberateCorr } = req.body;

  // Extrair ID da aula da URL
  const match = req.url.match(/\/editar-aula\/(\d+)/);
  if (!match) {
    return res.status(400).json({ error: 'ID da aula não fornecido' });
  }
  const aulaId = match[1];

  try {
    const [aulas] = await pool.execute(
      'SELECT * FROM aulas WHERE id = ? AND fk_professor_id = ?',
      [aulaId, user.id_nivel]
    );

    if (aulas.length === 0) {
      return res.status(404).json({ error: 'Aula não encontrada ou acesso negado' });
    }

    await pool.execute(
      `UPDATE aulas SET 
        titulo = ?, descricao = ?, data = ?, tipo = ?, ordem = ?, status = ?,
        exercicio = ?, slide = ?, correcao = ?,
        liberateSli = ?, liberateCorr = ?
       WHERE id = ? AND fk_professor_id = ?`,
      [titulo, descricao, data, tipo, ordem, status, exercicio, slide, correcao, liberateSli, liberateCorr, aulaId, user.id_nivel]
    );

    res.json({ success: true, message: 'Aula atualizada com sucesso' });
  } catch (error) {
    console.error('Erro ao atualizar aula:', error);
    res.status(500).json({ error: 'Erro ao atualizar aula' });
  }
}