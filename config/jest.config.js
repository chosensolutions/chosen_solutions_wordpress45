module.exports = {
  rootDir: '../',
  testPathIgnorePatterns: [],
  testMatch: [
    // Requests
    
    // Responses

    // Events

    // Middleware

    // Validators
    //'<rootDir>/src/validators/__tests__/**.test.js',

    /***** Domain *****/
    // Repositories
    //'<rootDir>/src/domain/repositories/__tests__/**.test.js',
    //'<rootDir>/src/domain/repositories/__tests__/book.repository.test.js',
    //'<rootDir>/src/domain/repositories/__tests__/user.repository.test.js',

    // Services
    //'<rootDir>/src/domain/services/__tests__/**.test.js',
    //'<rootDir>/src/domain/services/__tests__/book.service.test.js',
    //'<rootDir>/src/domain/services/__tests__/user.service.test.js',

    /***** API Tests *****/
    //'<rootDir>/tests/api/**.test.js'
  ],
  testTimeout: 3000,
  testEnvironment: 'node'
}
