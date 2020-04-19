module.exports = {
  rootDir: '../',
  testPathIgnorePatterns: [
    //'<rootDir>/mock-servers/'
  ],
  testMatch: [
    //'<rootDir>/tests/auth/register.test.js',
    //'<rootDir>/auth/login.test.js',
    
    //'<rootDir>/book/books.test.js'

   '<rootDir>/src/**/__tests__/**.test.js', 
    //'**/?(*.)(spec|test).js?(x)',
  ],
  testTimeout: 3000
}
