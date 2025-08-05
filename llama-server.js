import express from 'express';
import bodyParser from 'body-parser';
import { exec } from 'child_process';

const app = express();
const PORT = 5000;

app.use(bodyParser.json());

app.post('/api/chat', (req, res) => {
  const message = req.body.message;
  if (!message) {
    return res.status(400).json({ error: 'No message provided' });
  }

  const cmd = `./bin/llama-cli -m ../../models/deepseek-llm-7b-chat.Q4_K_M.gguf -p "${message}" -n`;

  exec(cmd, { timeout: 60000 }, (err, stdout, stderr) => {
    if (err) {
      console.error('❌ Exec error:', stderr);
      return res.status(500).json({ error: 'Model failed', details: stderr });
    }

    const output = stdout.trim();
    const response = output.split('\n').slice(-1)[0] || '⚠️ No response.';
    res.json({ response });
  });
});

app.listen(PORT, () => {
  console.log(`🧠 ML API listening at http://localhost:${PORT}/api/chat`);
});
