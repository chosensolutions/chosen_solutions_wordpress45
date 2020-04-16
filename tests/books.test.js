const fetch = require('node-fetch');
const api = require('../src/server');

const apiPort = Math.round(Math.random() * 65535);
const baseURL = `http://localhost:${apiPort}/api/v1`;

beforeAll(async () => {
  await api.listen(apiPort);
})

describe('test suite', () => {
  it('POST /auth/register', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com3",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com3 has registered.'
    })
  })

  it('POST /auth/register 2', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com4",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com4 has registered.'
    })
  })
})

afterAll(async () => {
  await api.close();
})
