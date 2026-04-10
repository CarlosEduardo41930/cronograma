const mysql = require('mysql2/promise');
require('dotenv').config();

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

module.exports = pool;