const fetch = require('node-fetch')
const api = require('../src/server')

const apiPort = Math.round(Math.random() * 65535)

beforeAll(async () => {
  await api.listen(apiPort)
})

describe('test suite', () => {
  xit('test 1', async () => {
    let response = await(await fetch(`http://localhost:${apiPort}/api/test`)).json();

    expect(response).toEqual({ 
    	message: 'test'
    })
  })

  xit('test 2', async () => {
    let response = await(await fetch(`http://localhost:${apiPort}/api/test`)).json();

    expect(response).toEqual({ 
      message: 'test'
    })
  })
})

afterAll(async () => {
  await api.close();
})
