module.exports = {
  rootDir: '../tests',
  testPathIgnorePatterns: [
    '<rootDir>/mock-servers/'
  ],
  testMatch: [
    '<rootDir>/auth/register.test.js',
    '<rootDir>/auth/login.test.js',
    
    //'<rootDir>/book/books.test.js'
  ],
  testTimeout: 3000
}
