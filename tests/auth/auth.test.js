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

describe('test suite', () => {
  it('POST /auth/register', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com1",
        "password":"yichen"
      })
    })).json();

    // const Datastore = require('nedb');
    // let db = new Datastore({});
    // console.log(db)

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com1 has registered.'
    });
  })

  xit('POST /auth/login', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com2",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com2 has registered.'
    });
  });

  xit('GET /auth/logout', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com2",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com2 has registered.'
    });
  });

  // Gets the currently authenticated user
  xit('GET /auth/user', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com2",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com2 has registered.'
    });
  });

});

afterAll(async () => {
  await api.close();
})
const fetch = require('node-fetch')
const api = require('../src/server')

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

describe('test suite', () => {
  it('POST /auth/register', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com1",
        "password":"yichen"
      })
    })).json();

    // const Datastore = require('nedb');
    // let db = new Datastore({});
    // console.log(db)

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com1 has registered.'
    });
  })

  xit('POST /auth/login', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com2",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com2 has registered.'
    });
  });

  xit('GET /auth/logout', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com2",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com2 has registered.'
    });
  });

  // Gets the currently authenticated user
  xit('GET /auth/user', async () => {
    let response = await(await fetch(`${baseURL}/auth/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        "email":"yichenzhu1337@gmail.com2",
        "password":"yichen"
      })
    })).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com2 has registered.'
    });
  });

});

afterAll(async () => {
  await api.close();
});