module.exports = {
  baseUrl: 'http://localhost:',
  port: 5000,
  apiPrefix: 'api/v1',
  apiVersion: 'v1',
  fullUrl: `${this.baseUrl}${port}/${apiPrefix}`,
  mongoURI: 'mongodb://localhost:27017/dev_db',
  sessionSecret: 'my-secret-session-dev'
}