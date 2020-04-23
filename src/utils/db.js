const config = require('../../config');

const mongoose = require('mongoose');

const db = (url = config.mongoURI, opts = {}) => {
  return mongoose.connect(url, { ...opts, useNewUrlParser: true })
}

module.exports = db;
