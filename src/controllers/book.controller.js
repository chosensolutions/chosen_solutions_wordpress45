const globalResponseDTO = require('../responses/globalResponseDTO');
const createBookRequestDTO = require('../requests/createBookRequestDTO');
const bookService = require('../domain/services/book.service');
const bookResponseDTO = require('../responses/bookResponseDTO');

const catchException = require('../utils/catchExceptions');

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getAllbooks = catchException(async (req, res, next) => {
  // 5. business logic
  const books = await bookService.getAllBooks();

    // 7. response
  return res.json(globalResponseDTO(
    status = 'success',
    code = 200,
    message = `List of all books in the database.`,
    data = books,
    errors = null
  ));
});

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getBookById = catchException(async (req, res, next) => {
  const bookId = req.params.id;

  // 5. business logic
  let book = await bookService.getBookById(bookId);

  // 7. response
  return res.json(globalResponseDTO(
    status = 'success',
    code = 200,
    message = `Book with the specified id.`,
    data = book,
    errors = null
  ));
});

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const createABook = catchException(async (req, res, next) => {
  // 1. POST /api/v1/books

  // 2. middleware: auth

  // 3. request
  const createBookRequest = createBookRequestDTO(req.body);

  // 4. validation
  const createBookValidation = createBookRequestDTO(createBookRequest);

  // 5. business logic
  const book = await bookService.createBook(req.body);

  // 7. response
  return res.status(200).json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Book has successfully been added to the database.`,
    data = book,
    errors = null
  ));
});

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const updateABook = catchException(async (req, res, next) => {
  // 5. business logic
  const book = await bookService.updateBookById(req.param.id, req.body);

  // 7. response
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `THe book has successfully been updated.`,
    data = book,
    errors = null
  ));
});

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const deleteABook = catchException(async (req, res, next) => {
  // 5. business logic
  const book = await bookService.deleteBookById(req.param.id);
  
  // 7. response
  const bookDTO = bookResponseDTO(book);
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The book with the id: ${bookDTO.id} was successfully deleted.`,
    data = bookDTO,
    errors = null
  ));
});

module.exports = {
  getAllbooks,
  getBookById,
  createABook,
  updateABook,
  deleteABook
};