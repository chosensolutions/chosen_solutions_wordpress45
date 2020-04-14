const fetch = require('node-fetch')
const api = require('../src/server')

const apiPort = 7000

beforeAll(async () => {
  await api.listen(apiPort)
})

describe('test suite', () => {
  it('test 1', async () => {
    let response = await(await fetch(`http://localhost:${apiPort}/api/test`)).json();

    expect(response).toEqual({ 
      message: 'test'
    })
  })

  it('test 2', async () => {
    let response = await(await fetch(`http://localhost:${apiPort}/api/test`)).json();

    expect(response).toEqual({ 
      message: 'test'
    })
  })
})

afterAll(async () => {
  await api.close();
})
