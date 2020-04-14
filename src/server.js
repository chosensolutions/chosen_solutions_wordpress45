const http = require('http')
const express = require('express');
const path = require('path');
const bodyParser = require("body-parser");

const app = express();
const session = require("express-session");

app.use(bodyParser.json());
app.use(
  session({
    secret: 'secret',
    resave: false,
    saveUninitialized: true
  })
);

// app.use(function (req, res, next) {
//     req.user = ('user' in req.session) ? req.session.user : null;
//     next();
// });
// app.use(function (req, res, next) {
//     req.username = req.session.username ? req.session.username : null;
//     console.log("HTTP request", req.username, req.method, req.url, req.body);
//     next();
// });

app.use('/api/v1/auth', require('./routes/auth.route'));
app.use('/api/v1/test', require('./routes/test.route'));

app.get('*', (req, res) => {
  res.status(200).json({
    message: '404 bro'
  })
});

module.exports = http.createServer(app);