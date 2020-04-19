module.exports = {
  rootDir: '../',
  testPathIgnorePatterns: [],
  testMatch: [
    //'<rootDir>/tests/**.test.js'
   '<rootDir>/src/**/__tests__/**.test.js',
  ],
  testTimeout: 3000
}
