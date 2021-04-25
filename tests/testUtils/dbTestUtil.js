const userFactory = require('../testUtils/factories/userFactory')

const BookModel = require('../../src/domain/models/book.model')
const UserModel = require('../../src/domain/models/user.model')

const setUpDatabase = async () => {
  await BookModel.deleteMany({})
  await UserModel.deleteMany({})

  const user = new UserModel({
    first_name: 'John',
    last_name: 'Doe',
    email: 'johndoe@email.com',
    password: 'password456',
    password_confirmation: 'password456',
    phone_number: '1234567890'
  })

  const newUser = await user.save()

  await userFactory(5)
}

const clearDatabase = async () => {
  await BookModel.deleteMany({})
  await UserModel.deleteMany({})
}

const seeInDatabase = async (Model, item) => {
  let findItem = await Model.findById(item.id)
  return findItem
}

const getAllTableData = async (Model) => {
  return await Model.find({})
}

module.exports = {
  setUpDatabase,
  clearDatabase,
  getAllTableData,
  seeInDatabase
}
