const config = require('../../../../config');
const mongoose = require("mongoose");
mongoose.connect(config.mongoURI, { useNewUrlParser: true });

const bookRepository = require('../book.repository');
const BookModel = require('../../models/book.model');
const userFactory = require('../../../../tests/testUtils/factories/userFactory');
const bookFactory = require('../../../../tests/testUtils/factories/bookFactory');

// look into this setup: https://jestjs.io/docs/en/configuration#setupfilesafterenv-array
beforeAll(async () => {
  //await BookModel.deleteMany({});

  await userFactory(5);
  //await bookFactory(5);
});

beforeEach(async () => {

});

afterEach(async () => {
  //await BookModel.deleteMany({});
});

describe('Test Suite: Book Repository', () => {

  it('Book Repository - getAll', async () => {
    let books = await bookRepository.getAll();

    //expect(books.length).toBe(5);
  });

  xit('Book Repository - getById', async () => {
    let book = await bookRepository.getById('56e6dd2eb4494ed008d595bd');

    expect(book).toBe(null);
  });

  xit('Book Repository - createBook', async () => {
    let newBook = {
      title: 'Harry Potter and the Awesome Book of Nothing',
      description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.`,
      price: 100,
      author: 'J.K. Rowling',
      datePublished: Date.now()
    }

    let book = await bookRepository.create(newBook);

    // need to implement this
    // $this->assertDatabaseHas('users', [
    //   'email' => 'sally@example.com',
    // ])

    //console.log(book);
  });

  xit('Book Repository - updateBookById', async () => {
    let newBook = {
      title: 'Harry Potter and the Awesome Book of Nothing',
      description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.`,
      price: 100,
      author: 'J.K. Rowling',
      datePublished: Date.now()
    }
    let book = await bookRepository.updateById('56e6dd2eb4494ed008d595bd', newBook);

    //console.log(book);
  });

  xit('Book Repository - deleteBookById', async () => {
    let book = await bookRepository.deleteById('56e6dd2eb4494ed008d595bd');

    //console.log(book);
  });
});

afterAll(async () => {
  await mongoose.connection.close();
});