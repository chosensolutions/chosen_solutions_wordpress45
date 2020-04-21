module.exports = {
  dbFile: 'db.testing.json',
  baseUrl: 'http://localhost:',
  port: Math.round(Math.random() * 65535),
  mongoURI: 'mongodb://localhost:27017/test_db',
  apiPrefix: 'api/v1',
  sessionSecret: 'my-secret-session-testing'
}