const db = require('../../utils/db');
const table = 'books';

// Retrieve - all book
const getAllBooks = (book) => {
  return db.get(table).find().value();
}

// Retrieve - one book
const getBookById = (id) => {
  return db.get(table).find({ id: id }).value();
}

// Create a book
const createBook = (newBook) => {
// make sure newBook has the same properties as bookModel

  return db.get(table).push(
    book
  ).write();
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