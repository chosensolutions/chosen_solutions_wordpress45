let config = require('./dev')

if (process.env.NODE_ENV === 'testing') {
  config = require('./testing')
}
else if (process.env.NODE_ENV === 'ci') {
  config = require('./ci')
} 

module.exports = config
