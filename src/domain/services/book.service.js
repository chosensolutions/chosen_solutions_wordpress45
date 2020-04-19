const bookRepository = require('../repositories/book.repository');

// Retrieve - all books
const getAllBooks = (book, title) => {
  return bookRepository.getAllBooks.filter(book => book.title == title);
}

// Retrieve - one
const getBookById = (id) => {
  return bookRepository.getBookById;
}

// Create a book
const createBook = (book) => {
  return bookRepository.createBook;
}

// Update a book
const updateBookById = (bookId, book) => {
  return bookRepository.updateBookById;
}

// Delete a book
const deleteBookById = (bookId) => {
  return bookRepository.deleteBookById;
}

module.exports = {
  getAllBooks,
  getBookById,
  createBook,
  updateBookById,
  deleteBookById
};