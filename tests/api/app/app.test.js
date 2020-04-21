const fetch = require('node-fetch');
const api = require('../../../src/server');

const apiPort = Math.round(Math.random() * 65535);

beforeAll(async () => {
  await api.listen(apiPort);
})

describe('App - General API', () => {

  it('GET /version', async () => {
    const response = await fetch(`http://localhost:${apiPort}/version`);
    const json = response.json();

    expect(reponse.status).toBe(200);
    expect(json.version).toBe(1);
  });

});

afterAll(async () => {
  await api.close();
});
