// Init - start
const low = require('lowdb')
const FileSync = require('lowdb/adapters/FileSync')

const adapter = new FileSync('./storage/db/db.json')
const db = low(adapter)
// Set some defaults (required if your JSON file is empty)
db.defaults({ posts: [], users: []  }).write();
// Init - end

// Create
db.get('users')
  .push({ id: 1, title: 'lowdb is awesome'})
  .write();

// Retrieve - All
db.get('users').find().value();
  
// Retrieve - one
db.get('users').find({ id: 1 }).value()

// Update
db.get('users')
  .find({ id: 1 })
  .assign({ title: 'hi!'})
  .write();

// Delete
db.get('users')
  .find({ id: 1 })
  .assign({})
  .write();