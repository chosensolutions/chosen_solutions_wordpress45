const faker = require('faker');

const userFactory = (Model, numberOfSeeds) => {
  for (let i = 1; i <= numberOfSeeds; i++) {
    const user = new Model({
      name: faker.name.findName()
    })

    user.save();
  }
}

module.exports = userFactory;

/**
 * Creates 100 Users in the database.
 * 
 * userFactory(require('./UserModel'), 100);
 */