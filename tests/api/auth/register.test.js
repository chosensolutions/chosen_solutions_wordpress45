const fetch = require('node-fetch')
const api = require('../../src/server')

const apiPort = Math.round(Math.random() * 65535)
const baseURL = `http://localhost:${apiPort}/api/v1`;

beforeAll(async () => {
  await api.listen(apiPort)
})

beforeEach(() => {
  //initializeCityDatabase();
});

afterEach(() => {
  //clearCityDatabase();
});

/**
 * 1. Arrange
 *  - setup the world
 * 2. Act
 *  - making the http call
 * 3. Assert
 *  1. database check
 *  2. response check
 */
describe('test suite', () => {

  it('POST /api/v1/auth/register', async () => {
    let user = {
      "email": "yichen@yichen.com",
      "password": "password"
    };

    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(user)
    })).json();

    expect(response).toMatchObject({
      status: "success",
      code: 200,
      message: `The email: ${user.email} has registered.`,
      data: user,
    });
  });

});

afterAll(async () => {
  await api.close();
})