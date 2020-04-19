const http = require('http')
const express = require('express');
const bodyParser = require("body-parser");
const app = express();
const session = require("express-session");

app.use(bodyParser.json());
app.use(
  session({
    secret: 'my-session-secret',
    resave: false,
    saveUninitialized: true
  })
);

const getRouter = require('./routes');
const router = getRouter();
app.use('/api/v1', router);

// 404 Not Found
router.get('*', (req, res) => {
  res.status(404).json({
    message: '404 bro'
  });
});

module.exports = http.createServer(app);