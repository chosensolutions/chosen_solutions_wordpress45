const bookRepository = require('../repositories/book.repository');

// Retrieve - all books
const getAllBooks = async (book) => {
  return bookRepository.getAllBooks();
}

// Retrieve - one
const getBookById = async (bookId) => {
  return bookRepository.getBookById(bookId);
}

// Create a book
const createBook = async (book) => {
  return bookRepository.createBook(book);
}

// Update a book
const updateBookById = async (bookId, book) => {
  return bookRepository.updateBookById(bookId, book);
}

// Delete a book
const deleteBookById = async (bookId) => {
  return bookRepository.deleteBookById(bookId);
}

module.exports = {
  getAllBooks,
  getBookById,
  createBook,
  updateBookById,
  deleteBookById
};