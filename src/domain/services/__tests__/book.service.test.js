const bookService = require('../book.service');

beforeAll(async () => {

});

afterEach(async () => {

});

describe('Test Suite: Book Service', () => {

  xit('Book Service - getAllBooks', async () => {
    let books = await bookService.getAllBooks();

    console.log(books);
  });

});

afterAll(async () => {

});