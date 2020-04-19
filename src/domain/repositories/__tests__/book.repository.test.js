const bookRepository = require('../book.repository');
const db = require('../../../utils/db');

beforeAll(() => {
  db.set('books', [])
    .write()
});

describe('Test Suite: Book Repository', () => {

  it('Book Repository - getAllBooks', () => {
    let books = bookRepository.getAllBooks();

    console.log(books);
  });

  it('Book Repository - getBookById', () => {
    let book = bookRepository.getBookById(1);

    console.log(book);
  });

  it('Book Repository - createBook', () => {
    let newBook = {
      id: 10000,
      title: 1,
      description: 1,
      price: 1,
      author: 1,
      datePublished: 1
    }

    let book = bookRepository.createBook(newBook);

    console.log(book);
  });

  it('Book Repository - updateBookById', () => {
    let newBook = {
      title: 2,
      description: 2,
      price: 2,
      author: 2,
      datePublished: 2
    }

    let book = bookRepository.updateBookById(10000, newBook);

    console.log(book);
  });

  it('Book Repository - deleteBookById', () => {
    let book = bookRepository.deleteBookById(1);

    console.log(book);
  });
});