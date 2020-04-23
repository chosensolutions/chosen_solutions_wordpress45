const fetch = require('node-fetch')
const api = require('../../../src/server')

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
      first_name: 'Yichen',
      last_name: 'Zhu',
      email: 'yichen@yichen.com',
      password: 'password123',
      password_confirmation: 'password123',
      phone_number: '1234567890'
    };

    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(user)
    })).json();

    expect(response).toMatchObject({
      status: "success",
      code: 200
    });
  });

});

afterAll(async () => {
  await api.close();
})