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
const getAllbooks = async (req, res, next) => {
  const books = await bookService.getAllBooks();

  return res.json(globalResponseDTO(
    status = 'success',
    code = 200,
    message = `List of all books in the database.`,
    data = books,
    errors = null
  ));
}

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getBookById = catchException(async (req, res, next) => {
  const bookId = req.params.id;
  
  let book = await bookService.getBookById(bookId);

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
const createABook = async (req, res, next) => {
  // 2. request
  const newBook = createBookRequestDTO(req.body);

  // 4. validation
  // const registerUserValidator = registerUserValidator(registerUserRequest);

  // 5. business logic
  const book = await bookService.createBook(req.body);

  // 7. response
  return res.status(200).json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const updateABook = async (req, res, next) => {
  const book = await bookService.updateBookById(req.param.id, req.body);

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const deleteABook = async (req, res, next) => {
  const book = await bookService.deleteBookById(req.param.id);

  const bookDTO = bookResponseDTO(book);

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The book with the id: ${bookDTO.id} was successfully deleted.`,
    data = {
      message: `The book with the id: ${bookDTO.id} was successfully deleted.`
    }
  ));
}

module.exports = {
  getAllbooks,
  getBookById,
  createABook,
  updateABook,
  deleteABook
};