const db = require('../../src/utils/db')
let dbConnection
const dbTestUtils = require('./dbTestUtil')

;(async function () {
  dbConnection = await db()

  await dbTestUtils.clearDatabase()

  await dbTestUtils.setUpDatabase()

  await dbConnection.disconnect()
})()
