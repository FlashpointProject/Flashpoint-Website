const express = require('express');
const path = require('path');

const app = express();

app.get('/', function(req, res) {
  res.sendFile(__dirname + '/docs/index.html');
});

app.use(express.static(path.join(__dirname, 'docs')));

app.listen(3003, () => {
  console.log(`Listening on http://localhost:3003/`);
});
