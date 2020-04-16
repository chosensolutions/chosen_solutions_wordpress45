const low = require('lowdb')
const FileSync = require('lowdb/adapters/FileSync')

const adapter = new FileSync('db.json')
const db = low(adapter)

// Set some defaults (required if your JSON file is empty)
db.defaults({ users: [] })
  .write()

  // Set a user using Lodash shorthand syntax
db.set('users', [])
  .write()

// db.get('users')
//   .push({ 
//     id: Math.random() * 1000000000000, 
//     email: 'yichen@yichen.com',
//     password: 'my-awesome-password'
//   })
//   .write()