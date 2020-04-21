const faker = require('faker');

const bookFactory = (Model, numberOfSeeds) => {
  for (let i = 1; i <= numberOfSeeds; i++) {
    const user = new Model({
      name: faker.name.findName()
    })

    user.save();
  }
}

module.exports = bookFactory;

/**
 * Creates 100 books in the database.
 * 
 * bookFactory(require('./BookModel'), 100);
 */