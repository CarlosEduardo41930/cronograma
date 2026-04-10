const mysql = require('mysql2/promise');
const bcrypt = require('bcryptjs');

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

  if (req.method === 'GET') {
    const [turmas] = await pool.execute(`
      SELECT t.id, t.turma, t.descricao, u.nome, u.nivel, p.id as professor_id, p.tipo as professor_tipo
      FROM turma t 
      LEFT JOIN usuario u ON t.fk_usuario_id = u.id 
      LEFT JOIN professor p ON t.fk_professor = p.id
      ORDER BY u.nome
    `);
    return res.json(turmas);
  }
  
  res.status(405).json({ error: 'Method not allowed' });
}