module.exports = {
  baseUrl: 'http://localhost:',
  port: Math.round(Math.random() * 65535),
  apiPrefix: 'api',
  apiVersion: 'v1',
  fullUrl: `${this.baseUrl}${port}/${apiPrefix}`,
  mongoURI: 'mongodb://localhost:27017/test_db',
  sessionSecret: 'my-secret-session-testing'
}