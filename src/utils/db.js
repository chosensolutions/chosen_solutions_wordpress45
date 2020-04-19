const config = require('../../config');
const low = require('lowdb');
const FileSync = require('lowdb/adapters/FileSync');

const adapter = new FileSync('./storage/db/' + config.db_file);
const db = low(adapter);

// Set some defaults (required if your JSON file is empty)
db.defaults({
  users: [],
  books: [],
  bookstores: []
}).write();

module.exports = db;