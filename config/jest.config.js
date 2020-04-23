module.exports = {
  rootDir: '../',
  testPathIgnorePatterns: [],
  testMatch: [
    /***** Domain *****/
    // Repositories
    //'<rootDir>/src/domain/repositories/__tests__/**.test.js',
    //'<rootDir>/src/domain/repositories/__tests__/book.repository.test.js',
    //'<rootDir>/src/domain/repositories/__tests__/user.repository.test.js',

    // Services
    //'<rootDir>/src/domain/services/__tests__/**.test.js',
    // '<rootDir>/src/domain/services/__tests__/book.service.test.js',
    //'<rootDir>/src/domain/services/__tests__/user.service.test.js',

    /***** HTTP *****/
    // Requests
    //'<rootDir>/src/resquests/__tests__/**.test.js',

    // Responses
    //'<rootDir>/src/responses/__tests__/**.test.js',

    // Events
    //'<rootDir>/src/events/__tests__/**.test.js',

    // Middleware
    //'<rootDir>/src/middleware/__tests__/**.test.js',

    // Validators
    //'<rootDir>/src/validators/__tests__/**.test.js',

    /***** Domain *****/
    // Repositories
    //'<rootDir>/src/domain/repositories/__tests__/**.test.js',
    // '<rootDir>/src/domain/repositories/__tests__/book.repository.test.js',
    //'<rootDir>/src/domain/repositories/__tests__/user.repository.test.js',

    // Services
    //'<rootDir>/src/domain/services/__tests__/**.test.js',
    // '<rootDir>/src/domain/services/__tests__/book.service.test.js',
    //'<rootDir>/src/domain/services/__tests__/user.service.test.js',

    /***** API Tests *****/
    // App
    '<rootDir>/tests/api/app/**.test.js',
    
    // Auth
    //'<rootDir>/tests/api/auth/**.test.js',
    //'<rootDir>/tests/api/auth/auth.test.js',
    //'<rootDir>/tests/api/auth/login.test.js',
    //'<rootDir>/tests/api/auth/register.test.js',

    // Book
    //'<rootDir>/tests/api/book/**.test.js',

    // Others
    // '<rootDir>/src/utils/__tests__/ApiException.test.js',
  ],
  testTimeout: 3000,
  testEnvironment: 'node'
}
