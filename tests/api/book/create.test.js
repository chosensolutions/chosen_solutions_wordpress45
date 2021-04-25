const fetch = require('node-fetch')
const api = require('../../../src/server')

const apiPort = Math.round(Math.random() * 65535)
const baseURL = `http://localhost:${apiPort}/api/v1`

const db = require('../../../src/utils/db')
let dbConnection
const dbTestUtils = require('../../../tests/testUtils/dbTestUtil')

beforeAll(async () => {
  await api.listen(apiPort)
  dbConnection = await db()
})

beforeEach(async () => {
  await dbTestUtils.setUpDatabase()
})

afterEach(async () => {
  await dbTestUtils.clearDatabase()
})

afterAll(async () => {
  await api.close()
  await dbConnection.disconnect()
})

describe('Books API - Create', () => {
  test.skip('POST /api/v1/books', async () => {
    const user = {
      email: 'johndoe@email.com',
      password: 'password456'
    }

    await fetch(`${baseURL}/auth/logout`)

    const userResponse = await fetch(`${baseURL}/auth/login`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(user)
    })

    const cookie = userResponse.headers.get('set-cookie')

    const response = await (
      await fetch(`${baseURL}/books`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          cookie
        },
        body: JSON.stringify({
          title: 'Harry Potter and the Order of the Phoenix',
          description: "Buy my book! It's awesome!",
          price: 100
        })
      })
    ).json()

    expect(response).toMatchObject({
      message: 'Book has successfully been added to the database.',
      data: {
        title: 'Harry Potter and the Order of the Phoenix',
        description: "Buy my book! It's awesome!",
        price: 100
      }
    })
  })
})
