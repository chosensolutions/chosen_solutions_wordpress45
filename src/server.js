const http = require('http')
const express = require('express');
const bodyParser = require("body-parser");
const app = express();
const session = require("express-session");

const mongoose = require('mongoose');
const mongoURI = 'mongodb://127.0.0.1/my_database';
mongoose.connect(mongoURI);

const config = require('../config');
const globalResponseDTO = require('./responses/globalResponseDTO');

app.use(bodyParser.json());
app.use(
  session({
    secret: config.sessionSecret,
    resave: false,
    saveUninitialized: true
  })
);

const getRouter = require('./routes');
const router = getRouter();
app.use('/api/v1', router);

// 404 API Endpoint Not Found
router.get('*', (req, res, next) => {
  return;
});

app.use((err, req, res, next) => {
  console.log(err.message)

  return res
    .status(500)
    .json(globalResponseDTO(
      status = "failed",
      code = 500,
      message = `Test mesage: your shit failed!`,
      data = {
        message: err.message,
        err: err.status
      },
    ));
});

// Event listeners
require('./events');

module.exports = http.createServer(app);