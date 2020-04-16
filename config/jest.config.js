module.exports = {
  rootDir: '../tests',
  testPathIgnorePatterns: [
    '<rootDir>/mock-servers/'
  ],
  testMatch: [
    '<rootDir>/auth.test.js',
    '<rootDir>/books.test.js'
  ],
  testTimeout: 3000
}
