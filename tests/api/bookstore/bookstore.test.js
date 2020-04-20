const fetch = require('node-fetch');
const api = require('../../../src/server');

const apiPort = Math.round(Math.random() * 65535);
const baseURL = `http://localhost:${apiPort}/api/v1`;

beforeAll(async () => {
  await api.listen(apiPort);
})

describe('Bookstores API', () => {

  it('Get /api/v1/bookstores', async () => {
    let response = await (await fetch(`${baseURL}/bookstores`)).json();

    expect(1).toEqual(1);
  });

  xit('Get /api/v1/books/1', async () => {
    let response = await (await fetch(`${baseURL}/bookstores/1`)).json();

    expect(1).toEqual(1);
  });

});

afterAll(async () => {
  await api.close();
});
