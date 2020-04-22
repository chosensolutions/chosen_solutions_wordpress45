const bookRepository = require('../repositories/book.repository');

// Retrieve - all books
const getAllBooks = async () => {
  return bookRepository.getAll();
}

// Retrieve - one
const getBookById = async (bookId) => {
  return bookRepository.getById(bookId);
}

// Create a book
const createBook = async (book) => {
  return bookRepository.create(book);
}

// Update a book
const updateBookById = async (bookId, book) => {
  return bookRepository.updateById(bookId, book);
}

// Delete a book
const deleteBookById = async (bookId) => {
  return bookRepository.deleteById(bookId);
}

module.exports = {
  getAllBooks,
  getBookById,
  createBook,
  updateBookById,
  deleteBookById
};