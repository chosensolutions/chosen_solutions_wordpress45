const config = require('../../../../config');
const mongoose = require("mongoose");
mongoose.connect(config.mongoURI, { useNewUrlParser: true });

const bookRepository = require('../book.repository');
const BookModel = require('../../models/book.model');

beforeAll(async () => {
  await UserModel.remove({});
});

afterEach(async () => {
  await UserModel.remove({});
});

describe('Test Suite: Book Repository', () => {

  it('Book Repository - getAllBooks', async () => {
    let books = await bookRepository.getAllBooks();

    console.log(books);
  });

  it('Book Repository - getBookById', async () => {
    let book = await bookRepository.getBookById(1);

    console.log(book);
  });

  it('Book Repository - createBook', async () => {
    let newBook = {
      id: 10000,
      title: 1,
      description: 1,
      price: 1,
      author: 1,
      datePublished: 1
    }

    let book = await bookRepository.createBook(newBook);

    console.log(book);
  });

  it('Book Repository - updateBookById', async () => {
    let newBook = {
      title: 2,
      description: 2,
      price: 2,
      author: 2,
      datePublished: 2
    }

    let book = await bookRepository.updateBookById(10000, newBook);

    console.log(book);
  });

  it('Book Repository - deleteBookById', async () => {
    let book = await bookRepository.deleteBookById(1);

    console.log(book);
  });
});

afterAll(async () => {
  await mongoose.connection.close();
});