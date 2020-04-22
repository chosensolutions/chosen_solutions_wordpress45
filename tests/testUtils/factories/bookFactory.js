const faker = require('faker');
const Model = require('../../../src/domain/models/book.model');

module.exports = async (numberOfSeeds) => {
  for (let i = 1; i <= numberOfSeeds; i++) {

    let entityFields = {
      title: faker.name.findName(),
      description: faker.lorem.paragraphs(3),
      price: faker.random.number(500),
      author: faker.name.findName(),
      datePublished: faker.date.past()
    }

    const entity = new Model(entityFields)

    await entity.save();
  }
}