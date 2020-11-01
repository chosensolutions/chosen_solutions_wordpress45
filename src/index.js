const server = require('./server')
// eslint-disable-next-line
const PORT = process.env.PORT || 5000

const db = require('./utils/db')

server.listen(PORT, async () => {
  await db() // start the database
  console.log(`Started on port ${PORT}`)
})
