const http = require('http')
const express = require('express')
const bodyParser = require('body-parser')
const app = express()
const session = require('express-session')

const config = require('../config')
const globalResponseDTO = require('./responses/globalResponseDTO')

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: true }))

const MongoStore = require('connect-mongo')(session)
const mongoose = require('mongoose')

app.use(
  session({
    secret: config.sessionSecret,
    resave: true,
    saveUninitialized: false,
    store: new MongoStore({
      mongooseConnection: mongoose.connection,
      collection: 'sessions'
    })
  })
)

// Define all the routes here
const getRouter = require('./routes')
const router = getRouter()
app.use('/api/v1', router)

// Global error catcher
app.use((err, req, res) => {
  console.log('===============================')
  console.log('Global Error Catcher:', err.name)
  console.log('===============================')
  if (err.name === 'ApiException') {
    console.error('ApiException', err)

    return res.status(err.code).json(
      globalResponseDTO({
        status: err.status,
        code: err.code,
        message: err.message,
        data: err.data,
        errors: err.errors
      })
    )
  } else if (err.name === 'MongoError') {
    console.error('MongoError', err)

    if (err.errmsg.includes('E11000 duplicate key error')) {
      return res.status(400).json(
        globalResponseDTO({
          status: 'failed',
          code: 400,
          message: err.errmsg,
          data: null,
          errors: ['This email is already taken.']
        })
      )
    }
  } else {
    console.error('Other Error', err)
  }
})

// Register all event listeners
require('./events')

module.exports = http.createServer(app)
