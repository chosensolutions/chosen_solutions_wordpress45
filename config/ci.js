module.exports = {
  baseUrl: 'http://localhost:',
  port: Math.round(Math.random() * 65535),
  apiPrefix: 'api',
  apiVersion: 'v1',
  baseUrl: `${this.baseUrl}${this.port}/${this.apiPrefix}/${this.apiVersion}`,
  mongoURI: process.env.MONGO_URI,
  sessionSecret: process.env.COOKIE_KEY
}
