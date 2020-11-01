const isAuthenticated = require('../auth.middleware')

describe('Middleware - authPermission', () => {
  test('Middleware - access denied', () => {
    // isAuthenticated({}, {}, () => {});
    // throws an exception
  })

  test('Middleware - access not denied', () => {
    // isAuthenticated({}, {}, function callback() { });
    // does not throws an exception and the callback get's called
  })
})
