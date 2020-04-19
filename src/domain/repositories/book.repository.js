const db = require('../../utils/db');
const table = 'books';

// Retrieve - all book
const getAllBooks = () => {
  return db.get(table).value();
}

// Retrieve - one book
const getBookById = (id) => {
  return db.get(table).find({ id: id }).value();
}

// Create a book
const createBook = (newBook) => {
  let books = db.get(table).push(newBook).write();
  let book = books[books.length - 1];
  return book;
}

// Update a book
const updateBookById = (bookId, book) => {
  return db.get(table).find({ id: bookId }).assign(book).write();
}

// Delete a book
const deleteBookById = (bookId) => {
  return db.get(table).find({ id: bookId }).assign({}).write();
}

module.exports = {
  getAllBooks,
  getBookById,
  createBook,
  updateBookById,
  deleteBookById
};