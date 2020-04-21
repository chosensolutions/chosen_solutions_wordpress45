const BookModel = require('../models/book.model');

// Retrieve - all book
const getAllBooks = async () => {
  return await BookModel.find({});
}

// Retrieve - one book
const getBookById = async (id) => {
  return await BookModel.find({ id });
}

// Create a book
const createBook = async (newBook) => {
  const newBook = new BookModel(newBook);
  const book = await newBook.save();
  return book;
}

// Update a book
const updateBookById = async (id, book) => {
  return await BookModel.find({ id }).save(book);
}

// Delete a book
const deleteBookById = async (id) => {
  const book = await BookModel.find({ id }).remove();
  return book;
}

module.exports = {
  getAllBooks,
  getBookById,
  createBook,
  updateBookById,
  deleteBookById
};