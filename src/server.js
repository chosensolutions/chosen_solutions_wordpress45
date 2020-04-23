const http = require('http')
const express = require('express');
const bodyParser = require("body-parser");
const app = express();
const session = require("express-session");

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
// router.get('*', (req, res, next) => {
//   return res
//     .status(404)
//     .json(globalResponseDTO(
//       status = "failed",
//       code = 404,
//       message = `Test message: your shit failed!`,
//       data = {
//         message: err.message,
//         err: err.status
//       },
//     ));
// });

app.use((err, req, res, next) => {
  // log it out into the conosle
  console.log('global error catcher:', err.name);
  if (err.name === 'ApiException') {
    console.log(err);
  }

  // return it in the GUI
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