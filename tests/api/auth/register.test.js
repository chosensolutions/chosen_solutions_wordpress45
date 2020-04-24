const fetch = require('node-fetch')
const api = require('../../../src/server')

const apiPort = Math.round(Math.random() * 65535)
const baseURL = `http://localhost:${apiPort}/api/v1`;
const db = require('../../../src/utils/db');
let dbConnection;

const ApiException = require('../../../src/utils/ApiException');

beforeAll(async () => {
  //await db();
  await api.listen(apiPort);
  dbConnection = await db(); // start the database
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
describe('API Test - Register User', () => {

  it('POST /api/v1/auth/register - happy path', async () => {
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

    delete user.password_confirmation;

    expect(response).toMatchObject({
      status: "success",
      code: 200,
      message: `The email: ${user.email} has successfully registered.`,
      data: user
    });
  });

  xit('POST /api/v1/auth/register - duplicate email', async () => {
    let user = {
      first_name: 'Yichen',
      last_name: 'Zhu',
      email: 'yichen@yichen.com',
      password: 'password123',
      password_confirmation: 'password123',
      phone_number: '1234567890'
    };

    // delete user.password_confirmation;

    expect(async () => {
      await(await fetch(`${baseURL}/auth/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(user)
      })).json();

      await(await fetch(`${baseURL}/auth/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(user)
      })).json();

    }).toThrow(ApiException);
  });

});

afterAll(async () => {
  await api.close();
  await dbConnection.disconnect();
})