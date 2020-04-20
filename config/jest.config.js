module.exports = {
  rootDir: '../',
  testPathIgnorePatterns: [],
  testMatch: [
    //'<rootDir>/tests/**.test.js'
    //'<rootDir>/src/domain/repositories/__tests__/**.test.js',

    //'<rootDir>/src/**/__tests__/**.test.js',

    //'<rootDir>/tests/api/bookstore/**.test.js',


    //'<rootDir>/src/validators/__tests__/**.test.js',

    '<rootDir>/src/domain/repositories/__tests__/user.repository.test.js',
  ],
  testTimeout: 3000,
  testEnvironment: 'node'
}
