const fetch = require('node-fetch')
const api = require('../src/server')

const apiPort = Math.round(Math.random() * 65535)

beforeAll(async () => {
  await api.listen(apiPort)
})

describe('test suite', () => {
  it('test 1', async () => {
    let response = await(await fetch(`http://localhost:${apiPort}/api/v1/test`)).json();

    expect(response).toEqual({ 
      message: 'test'
    })
  })

  it('test 2', async () => {
    let response = await(await fetch(`http://localhost:${apiPort}/api/v2/test`)).json();

    expect(response).toEqual({ 
      message: '404 bro'
    })
  })
})

afterAll(async () => {
  await api.close();
})
