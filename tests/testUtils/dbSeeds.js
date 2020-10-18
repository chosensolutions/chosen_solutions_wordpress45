const db = require('../../src/utils/db')
let dbConnection
const dbTestUtils = require('./dbTestUtil')

;(async () => {
  dbConnection = await db()

  await dbTestUtils.clearDatabase()

  await dbTestUtils.setUpDatabase()

  await dbConnection.disconnect()
})()